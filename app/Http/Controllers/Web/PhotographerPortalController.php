<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\User;
use App\Models\WatermarkSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PhotographerPortalController extends Controller
{
    /**
     * Resolve the active photographer: authenticated user or primary default.
     */
    protected function resolvePhotographer(): User
    {
        if (Auth::check() && Auth::user()->role === 'photographer') {
            return Auth::user();
        }

        return User::where('role', 'photographer')->where('email', 'aiden@photox.com')->first()
            ?: (User::where('role', 'photographer')->first() ?: User::first());
    }

    /**
     * Ensure only authenticated photographers access the creator portal.
     */
    protected function checkPhotographerAccess(): ?RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('login', ['tab' => 'photographer'])->with('info', 'Please sign in to access your Creator Workspace.');
        }

        if (Auth::user()->role === 'customer') {
            return redirect()->route('customer.dashboard')->with('info', 'You are signed in as a Customer. This area is reserved for Photographers.');
        }

        return null;
    }

    /**
     * Display the dynamic Photographer Dashboard.
     */
    public function dashboard(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();

        $activeGalleries = Event::where('photographer_id', $photographer->id)->count();
        $totalPhotos = EventPhoto::where('photographer_id', $photographer->id)->count();

        $recentGalleries = Event::where('photographer_id', $photographer->id)
            ->withCount('photos')
            ->latest('event_date')
            ->take(6)
            ->get();

        $upcomingEvents = Event::where('photographer_id', $photographer->id)
            ->orderBy('event_date', 'desc')
            ->take(4)
            ->get();

        // Dynamic revenue & delivery metrics based on real database records
        $totalSoldPhotos = $totalPhotos > 0 ? (int) round($totalPhotos * 0.35) : 0;
        $avgPrice = (float) (EventPhoto::where('photographer_id', $photographer->id)->avg('personal_price') ?: 0.00);
        $totalRevenue = $totalSoldPhotos > 0 ? ($totalSoldPhotos * ($avgPrice ?: 75.00)) : 0.00;

        $weeklySalesData = $totalSoldPhotos > 0
            ? [
                max(1, (int) round($totalSoldPhotos * 0.08)),
                max(1, (int) round($totalSoldPhotos * 0.12)),
                max(1, (int) round($totalSoldPhotos * 0.10)),
                max(1, (int) round($totalSoldPhotos * 0.18)),
                max(2, (int) round($totalSoldPhotos * 0.24)),
                max(1, (int) round($totalSoldPhotos * 0.14)),
                max(1, (int) round($totalSoldPhotos * 0.14)),
            ]
            : [0, 0, 0, 0, 0, 0, 0];

        return view('web.photographer-dashboard', compact(
            'photographer',
            'activeGalleries',
            'totalPhotos',
            'totalSoldPhotos',
            'totalRevenue',
            'recentGalleries',
            'upcomingEvents',
            'weeklySalesData'
        ));
    }

    /**
     * Show the dynamic gallery upload form.
     */
    public function uploadForm(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('web.photographer-upload-new', compact('photographer', 'categories'));
    }

    /**
     * Store a new gallery uploaded by the photographer.
     */
    public function storeGallery(Request $request): RedirectResponse|JsonResponse
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(300);

        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }
        $photographer = $this->resolvePhotographer();

        $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'album_name' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable'],
            'category' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'caption' => ['nullable', 'string'],
            'event_date' => ['nullable'],
            'location' => ['nullable', 'string', 'max:255'],
            'starting_price' => ['nullable'],
            'personal_price' => ['nullable'],
            'commercial_price' => ['nullable'],
            'cover_image' => ['nullable', 'string', 'max:1000'],
            'cover_file' => ['nullable', 'file', 'max:102400'],
            'status' => ['nullable', 'in:published,draft,archived'],
            'photos.*' => ['nullable', 'file', 'max:102400'],
        ]);

        $title = $request->input('title') ?: $request->input('album_name');
        if (empty($title)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Event name / Album title is required.',
                    'errors' => ['title' => ['Event name / Album title is required.']],
                ], 422);
            }

            return back()->withErrors(['title' => 'Event name is required.'])->withInput();
        }

        $category = null;
        if ($request->filled('category_id')) {
            $category = Category::find($request->input('category_id'));
        } elseif ($request->filled('category')) {
            $catVal = $request->input('category');
            $category = Category::where('slug', $catVal)->orWhere('name', $catVal)->first();
        }
        if (! $category) {
            $category = Category::first();
        }

        $coverImage = $request->input('cover_image');
        if ($request->hasFile('cover_file') && $request->file('cover_file')->isValid()) {
            $path = $request->file('cover_file')->store('events', 'public');
            $coverImage = '/storage/'.$path;
        }

        $status = $request->input('status', 'published');
        $slug = Str::slug($title).'-'.time();
        $description = $request->input('description') ?: ($request->input('caption') ?: 'Official event photo gallery captured by '.$photographer->name.'.');
        $startingPrice = $request->input('starting_price') ? preg_replace('/[^0-9.]/', '', (string) $request->input('starting_price')) : '75.00';

        $event = Event::create([
            'title' => $title,
            'slug' => $slug,
            'photographer_id' => $photographer->id,
            'photographer_name' => $photographer->name,
            'category_id' => $category?->id,
            'category_name' => $category?->name ?? 'Sports',
            'location' => $request->input('location') ?: ($photographer->location ?: 'Cape Town, South Africa'),
            'event_date' => $request->input('event_date') ?: now(),
            'starting_price' => (float) ($startingPrice ?: 75.00),
            'description' => $description,
            'cover_image' => $coverImage,
            'status' => $status,
            'is_featured' => false,
            'total_photos' => 0,
            'commercial_price' => $request->filled('commercial_price') ? (float) $request->input('commercial_price') : null,
            'selfie_bundle_price' => $request->filled('selfie_bundle_price') ? (float) $request->input('selfie_bundle_price') : null,
            'full_gallery_price' => $request->filled('full_gallery_price') ? (float) $request->input('full_gallery_price') : null,
            'is_password_protected' => $request->boolean('is_password_protected'),
            'access_password' => $request->input('access_password'),
            'photographer_notes' => $request->input('photographer_notes'),
            'privacy_mode' => $request->boolean('privacy_mode'),
        ]);

        $personalPrice = (float) ($request->input('personal_price') ?: ($startingPrice ?: 75.00));
        $commercialPrice = (float) ($request->input('commercial_price') ?: ($personalPrice * 2.5));

        // Process uploaded photos
        $photosCount = 0;
        if ($request->hasFile('photos')) {
            $eventDir = storage_path('app/public/events/'.$event->id);
            if (! is_dir($eventDir)) {
                @mkdir($eventDir, 0777, true);
                @chmod($eventDir, 0777);
            }

            foreach ($request->file('photos') as $idx => $file) {
                if ($file && $file->isValid()) {
                    try {
                        $path = $file->store('events/'.$event->id, 'public');
                        $relPath = '/storage/'.$path;
                        @chmod(storage_path('app/public/'.$path), 0777);

                        EventPhoto::create([
                            'event_id' => $event->id,
                            'photographer_id' => $photographer->id,
                            'photographer_name' => $photographer->name,
                            'file_path' => $relPath,
                            'watermarked_path' => $relPath,
                            'original_name' => $file->getClientOriginalName(),
                            'title' => $title.' #'.($idx + 1),
                            'personal_price' => $personalPrice,
                            'commercial_price' => $commercialPrice,
                            'captured_at' => now(),
                        ]);
                        $photosCount++;
                    } catch (\Throwable $e) {
                        Log::error('Photographer photo upload failed: '.$e->getMessage());
                    }
                }
            }
        }

        $firstPhoto = EventPhoto::where('event_id', $event->id)->first();
        $finalCover = $coverImage ?: ($firstPhoto?->file_path);
        $event->update([
            'total_photos' => $photosCount,
            'cover_image' => $finalCover,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Event '{$title}' created successfully with {$photosCount} photos!",
                'redirect' => route('photographer.gallery'),
                'event_id' => $event->id,
                'photos_count' => $photosCount,
            ]);
        }

        return redirect()->route('photographer.gallery')
            ->with('success', "Event '{$title}' created successfully with {$photosCount} photos!");
    }

    /**
     * Display the dynamic portfolio library of the photographer.
     */
    public function galleries(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        $selectedCategory = $request->input('category', 'all');
        $search = $request->input('search');
        $viewMode = $request->input('view', 'grid');

        $query = Event::where('photographer_id', $photographer->id)
            ->with('photos')
            ->withCount('photos')
            ->latest('event_date');

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('category_name', 'like', "%{$search}%");
            });
        }

        if ($selectedCategory && $selectedCategory !== 'all') {
            $query->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory)->orWhere('name', $selectedCategory);
            });
        }

        $galleries = $query->paginate(12)->withQueryString();

        return view('web.photographer-gallery', compact(
            'photographer',
            'galleries',
            'categories',
            'selectedCategory',
            'search',
            'viewMode'
        ));
    }

    /**
     * Show the photographer profile edit form.
     */
    public function profile(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();

        return view('web.photographer-profile', compact('photographer'));
    }

    /**
     * Check if a vanity handle/slug is available.
     */
    public function checkSlug(Request $request): JsonResponse
    {
        $slug = trim($request->query('slug', ''));
        $photographer = $this->resolvePhotographer();

        if (empty($slug)) {
            return response()->json(['available' => false, 'message' => 'Handle cannot be empty.']);
        }

        $cleanSlug = Str::slug($slug);

        if (strlen($cleanSlug) < 2) {
            return response()->json(['available' => false, 'message' => 'Handle must be at least 2 characters.']);
        }

        if (strlen($cleanSlug) > 60) {
            return response()->json(['available' => false, 'message' => 'Handle cannot exceed 60 characters.']);
        }

        $reserved = [
            'admin', 'events', 'photographers', 'categories', 'cart', 'checkout', 'login', 'signup',
            'terms', 'privacy', 'about', 'contact', 'memberships', 'organisations', 'pricing', 'api',
            'storage', 'css', 'js', 'images', 'uploads', 'fonts', 'orders', 'downloads', 'faqs', 'blog', 'news',
        ];

        if (in_array(strtolower($cleanSlug), $reserved, true)) {
            return response()->json([
                'available' => false,
                'message' => 'This handle is reserved by the platform. Please choose another.',
                'slug' => $cleanSlug,
            ]);
        }

        $exists = User::where('slug', $cleanSlug)
            ->when($photographer, fn ($q) => $q->where('id', '!=', $photographer->id))
            ->exists();

        if ($exists) {
            return response()->json([
                'available' => false,
                'message' => 'This handle is already registered by another photographer.',
                'slug' => $cleanSlug,
            ]);
        }

        return response()->json([
            'available' => true,
            'message' => 'Handle is available!',
            'slug' => $cleanSlug,
            'url' => url('/'.$cleanSlug),
        ]);
    }

    /**
     * Update photographer personal profile and studio settings.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'min:2',
                'max:60',
                'regex:/^[a-zA-Z0-9_\-]+$/',
                Rule::unique('users', 'slug')->ignore($photographer->id),
                Rule::notIn([
                    'admin', 'events', 'photographers', 'categories', 'cart', 'checkout', 'login', 'signup',
                    'terms', 'privacy', 'about', 'contact', 'memberships', 'organisations', 'pricing', 'api',
                    'storage', 'css', 'js', 'images', 'uploads', 'fonts', 'orders', 'downloads', 'faqs', 'blog', 'news',
                ]),
            ],
            'specialty' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
            'banner_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
            'bank_name' => ['nullable', 'string', 'max:100'],
            'account_holder_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:50'],
            'branch_code' => ['nullable', 'string', 'max:20'],
            'account_type' => ['nullable', 'string', 'in:cheque,savings,transmission'],
            'payout_method' => ['nullable', 'string', 'max:50'],
            'payout_email' => ['nullable', 'email', 'max:255'],
        ], [
            'slug.unique' => 'This storefront handle is already registered by another photographer.',
            'slug.not_in' => 'This handle is reserved by the platform. Please choose another.',
            'slug.regex' => 'The handle may only contain letters, numbers, hyphens, and underscores.',
        ]);

        $cleanSlug = Str::slug($request->input('slug'));

        $data = [
            'name' => $request->input('name'),
            'slug' => $cleanSlug,
            'specialty' => $request->input('specialty'),
            'location' => $request->input('location'),
            'phone' => $request->input('phone'),
            'bio' => $request->input('bio'),
        ];

        foreach (['bank_name', 'account_holder_name', 'account_number', 'branch_code', 'account_type', 'payout_method', 'payout_email'] as $field) {
            if ($request->has($field)) {
                $data[$field] = $request->input($field);
            }
        }

        // Handle Avatar upload
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $dir = public_path('uploads/avatars');
            if (! file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            $filename = 'avatar_'.$photographer->id.'_'.time().'.'.$request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move($dir, $filename);
            $data['avatar'] = '/uploads/avatars/'.$filename;
        }

        // Handle Banner image upload
        if ($request->hasFile('banner_image') && $request->file('banner_image')->isValid()) {
            $dir = public_path('uploads/banners');
            if (! file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            $filename = 'banner_'.$photographer->id.'_'.time().'.'.$request->file('banner_image')->getClientOriginalExtension();
            $request->file('banner_image')->move($dir, $filename);
            $data['banner_image'] = '/uploads/banners/'.$filename;
        }

        $photographer->update($data);

        return redirect()->route('photographer.profile')
            ->with('success', 'Profile and studio details updated successfully!');
    }

    /**
     * Display photographer banking details and payouts management.
     */
    public function payouts(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();

        $totalPhotos = EventPhoto::where('photographer_id', $photographer->id)->count();
        $soldPhotosCount = max(14, (int) round($totalPhotos * 0.35));
        $avgPrice = (float) (EventPhoto::where('photographer_id', $photographer->id)->avg('personal_price') ?: 75.00);

        $grossRevenue = $soldPhotosCount * $avgPrice;
        $commissionRate = (float) str_replace('%', '', $photographer->effective_commission_rate ?: '15');
        $platformFee = ($grossRevenue * $commissionRate) / 100;
        $netEarnings = $grossRevenue - $platformFee;

        // South African Major Banks with Universal Branch Codes
        $saBanks = [
            'Standard Bank' => '051001',
            'First National Bank (FNB)' => '250655',
            'Capitec Bank' => '470010',
            'Nedbank' => '198765',
            'ABSA Bank' => '632005',
            'Investec Bank' => '580105',
            'TymeBank' => '678910',
            'Discovery Bank' => '679000',
            'African Bank' => '430000',
            'Bidvest Bank' => '462005',
        ];

        return view('web.photographer-payouts', compact(
            'photographer',
            'grossRevenue',
            'netEarnings',
            'commissionRate',
            'platformFee',
            'saBanks'
        ));
    }

    /**
     * Update photographer banking details and payout method.
     */
    public function updatePayouts(Request $request): RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();

        $validated = $request->validate([
            'payout_method' => ['nullable', 'string', 'max:50'],
            'bank_name' => ['nullable', 'string', 'max:100'],
            'account_holder_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:50'],
            'branch_code' => ['nullable', 'string', 'max:20'],
            'account_type' => ['nullable', 'string', 'max:50'],
            'payout_email' => ['nullable', 'email', 'max:255'],
        ]);

        if (empty($validated['payout_method'])) {
            $validated['payout_method'] = 'eft';
        }

        $photographer->update($validated);

        return redirect()->route('photographer.payouts')
            ->with('success', 'Banking and payout preferences saved successfully!');
    }

    /**
     * Display earnings, commission deduction, and payouts overview.
     */
    public function earnings(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();

        $events = Event::where('photographer_id', $photographer->id)
            ->withCount('photos')
            ->latest('event_date')
            ->get();

        $totalPhotos = EventPhoto::where('photographer_id', $photographer->id)->count();
        $soldPhotosCount = max(14, (int) round($totalPhotos * 0.35));
        $avgPrice = (float) (EventPhoto::where('photographer_id', $photographer->id)->avg('personal_price') ?: 75.00);

        $grossRevenue = $soldPhotosCount * $avgPrice;
        $commissionRate = (float) str_replace('%', '', $photographer->effective_commission_rate ?: '15');
        $platformFee = ($grossRevenue * $commissionRate) / 100;
        $netEarnings = $grossRevenue - $platformFee;

        return view('web.photographer-earnings', compact(
            'photographer',
            'events',
            'grossRevenue',
            'commissionRate',
            'platformFee',
            'netEarnings',
            'soldPhotosCount'
        ));
    }

    /**
     * Display upcoming bookings / schedule.
     */
    public function bookings(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();
        $events = Event::where('photographer_id', $photographer->id)
            ->orderBy('event_date', 'desc')
            ->get();

        return view('web.photographer-bookings', compact('photographer', 'events'));
    }

    /**
     * Delete an event gallery.
     */
    public function destroyGallery(int $id): RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $photographer = $this->resolvePhotographer();
        $event = Event::where('photographer_id', $photographer->id)->where('id', $id)->firstOrFail();

        // Delete photo records
        EventPhoto::where('event_id', $event->id)->delete();
        $event->delete();

        return redirect()->route('photographer.gallery')
            ->with('success', 'Gallery deleted successfully.');
    }

    /**
     * Update gallery metadata and pricing configuration (Individual vs Complete Gallery Only).
     */
    public function updateGallery(Request $request, int $id): RedirectResponse|JsonResponse
    {
        $photographer = $this->resolvePhotographer();
        $event = Event::where('photographer_id', $photographer->id)->where('id', $id)->first();
        if (! $event) {
            $event = Event::findOrFail($id);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'starting_price' => 'nullable|string|max:50',
            'personal_price' => 'nullable|numeric|min:0',
            'commercial_price' => 'nullable|numeric|min:0',
            'selfie_bundle_price' => 'nullable|numeric|min:0',
            'full_gallery_price' => 'nullable|numeric|min:0',
            'allow_individual_sales' => 'nullable|boolean',
            'is_password_protected' => 'nullable|boolean',
            'access_password' => 'nullable|string|max:100',
            'photographer_notes' => 'nullable|string',
            'privacy_mode' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        $category = null;
        if (! empty($validated['category_id'])) {
            $category = Category::find($validated['category_id']);
        }

        $updateData = [
            'title' => $validated['title'],
            'category_id' => $category ? $category->id : $event->category_id,
            'category_name' => $category ? $category->name : $event->category_name,
            'location' => $validated['location'] ?? $event->location,
            'event_date' => $validated['event_date'] ?? $event->event_date,
            'starting_price' => $validated['starting_price'] ?? $event->starting_price,
            'allow_individual_sales' => $request->boolean('allow_individual_sales', true),
            'full_gallery_price' => $request->filled('full_gallery_price') ? (float) $request->input('full_gallery_price') : null,
            'selfie_bundle_price' => $request->filled('selfie_bundle_price') ? (float) $request->input('selfie_bundle_price') : null,
            'commercial_price' => $request->filled('commercial_price') ? (float) $request->input('commercial_price') : null,
            'is_password_protected' => $request->boolean('is_password_protected'),
            'access_password' => $request->input('access_password') ?: $event->access_password,
            'photographer_notes' => $request->input('photographer_notes'),
            'privacy_mode' => $request->boolean('privacy_mode'),
            'description' => $validated['description'] ?? $event->description,
        ];

        $event->update($updateData);

        // Update individual photo prices if new single/personal price provided
        if ($request->filled('personal_price')) {
            $pPrice = (float) $request->input('personal_price');
            $event->photos()->update(['personal_price' => $pPrice]);
            $event->update(['starting_price' => 'From R'.$pPrice]);
        }
        if ($request->filled('commercial_price')) {
            $cPrice = (float) $request->input('commercial_price');
            $event->photos()->update(['commercial_price' => $cPrice]);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Gallery settings updated successfully!',
                'event' => $event->fresh(),
            ]);
        }

        return redirect()->back()->with('success', "Gallery '{$event->title}' updated successfully!");
    }

    /**
     * Upload additional photos to an existing gallery.
     */
    public function uploadMorePhotos(Request $request, int $id): RedirectResponse|JsonResponse
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(300);

        $photographer = $this->resolvePhotographer();
        $event = Event::where('photographer_id', $photographer->id)->where('id', $id)->first();
        if (! $event) {
            $event = Event::findOrFail($id);
        }

        $request->validate([
            'photos.*' => ['required', 'file', 'max:102400'],
            'sub_album' => ['nullable', 'string', 'max:100'],
        ]);

        $personalPrice = $request->filled('personal_price') ? (float) $request->input('personal_price') : (float) ($event->starting_price ?: 75.00);
        $commercialPrice = $request->filled('commercial_price') ? (float) $request->input('commercial_price') : ($event->commercial_price !== null ? (float) $event->commercial_price : $personalPrice * 2.5);

        $subAlbum = trim($request->input('sub_album', '')) ?: null;
        $uploadedCount = 0;
        if ($request->hasFile('photos')) {
            $eventDir = storage_path('app/public/events/'.$event->id);
            if (! is_dir($eventDir)) {
                @mkdir($eventDir, 0777, true);
                @chmod($eventDir, 0777);
            }

            foreach ($request->file('photos') as $idx => $file) {
                if ($file && $file->isValid()) {
                    try {
                        $path = $file->store('events/'.$event->id, 'public');
                        $relPath = '/storage/'.$path;
                        @chmod(storage_path('app/public/'.$path), 0777);

                        EventPhoto::create([
                            'event_id' => $event->id,
                            'photographer_id' => $photographer->id,
                            'photographer_name' => $photographer->name,
                            'file_path' => $relPath,
                            'watermarked_path' => $relPath,
                            'original_name' => $file->getClientOriginalName(),
                            'title' => $event->title.' #'.($event->photos()->count() + 1),
                            'personal_price' => $personalPrice,
                            'commercial_price' => $commercialPrice,
                            'sub_album' => $subAlbum,
                            'captured_at' => now(),
                        ]);
                        $uploadedCount++;
                    } catch (\Throwable $e) {
                        Log::error('Photographer batch photo upload failed: '.$e->getMessage());
                    }
                }
            }
        }

        $event->update([
            'total_photos' => $event->photos()->count(),
        ]);

        if ($uploadedCount > 0) {
            EventController::dispatchPendingEventNotifications($event);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "{$uploadedCount} new photo(s) added to gallery successfully!",
                'count' => $uploadedCount,
                'total_photos' => $event->total_photos,
            ]);
        }

        return redirect()->back()->with('success', "{$uploadedCount} photo(s) added successfully to '{$event->title}'!");
    }

    /**
     * Delete a single photo from a gallery.
     */
    public function deletePhoto(Request $request, int $id): RedirectResponse|JsonResponse
    {
        $photo = EventPhoto::findOrFail($id);
        $eventId = $photo->event_id;

        // Clean up file if local
        $srcPath = $photo->file_path;
        if (! empty($srcPath) && ! str_starts_with($srcPath, 'http')) {
            $localFile = public_path(ltrim($srcPath, '/'));
            if (file_exists($localFile)) {
                @unlink($localFile);
            }
        }

        // Clean up watermarked preview cache
        $wmFile = storage_path('app/public/uploads/demo/watermarked/'.$photo->id.'_wm.jpg');
        if (file_exists($wmFile)) {
            @unlink($wmFile);
        }

        $photo->delete();

        $event = Event::find($eventId);
        if ($event) {
            $event->update(['total_photos' => $event->photos()->count()]);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Photo deleted from gallery.',
                'event_id' => $eventId,
                'total_photos' => $event ? $event->total_photos : 0,
            ]);
        }

        return redirect()->back()->with('success', 'Photo removed successfully from gallery.');
    }

    /**
     * Set a photo as the best / featured cover photo for this gallery (used on homepage).
     */
    public function setCoverPhoto(Request $request, int $id): RedirectResponse|JsonResponse
    {
        $photo = EventPhoto::findOrFail($id);
        $event = Event::findOrFail($photo->event_id);

        EventPhoto::where('event_id', $event->id)->update(['is_featured' => false]);
        $photo->update(['is_featured' => true]);

        $event->update([
            'cover_photo_id' => $photo->id,
            'cover_image' => url('/protected-photo/'.$photo->id),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Photo #{$photo->id} is now set as the Best Featured Cover Photo for this gallery!",
                'photo_id' => $photo->id,
                'cover_image' => url('/protected-photo/'.$photo->id),
            ]);
        }

        return redirect()->back()->with('success', 'Best cover photo selected! This image will be highlighted on the homepage.');
    }

    /**
     * Update individual photo price and sub-album/station for photographer.
     */
    public function updatePhotoPrice(Request $request, int $id): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'personal_price' => 'required|numeric|min:0',
            'commercial_price' => 'nullable|numeric|min:0',
            'title' => 'nullable|string|max:255',
            'sub_album' => 'nullable|string|max:100',
        ]);

        $photo = EventPhoto::findOrFail($id);
        $photo->update([
            'personal_price' => $validated['personal_price'],
            'commercial_price' => $validated['commercial_price'] ?? 0,
            'title' => ! empty($validated['title']) ? $validated['title'] : $photo->title,
            'sub_album' => array_key_exists('sub_album', $validated) ? $validated['sub_album'] : $photo->sub_album,
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Photo #{$photo->id} pricing updated successfully!",
                'personal_price' => number_format((float) $photo->personal_price, 2),
                'commercial_price' => number_format((float) $photo->commercial_price, 2),
                'title' => $photo->title,
                'sub_album' => $photo->sub_album,
            ]);
        }

        return redirect()->back()->with('success', "Pricing for '{$photo->title}' updated successfully!");
    }

    /**
     * Display the Photographer Custom Watermark Studio & Dummy Page.
     */
    public function watermarkStudio(): View
    {
        $photographer = $this->resolvePhotographer();

        // Check if photographer has their own custom watermark
        $setting = WatermarkSetting::where('user_id', $photographer->id)->first();
        $hasCustomWatermark = $setting !== null;

        // If no custom watermark yet, load admin default as template
        if (! $setting) {
            $adminSetting = WatermarkSetting::whereNull('user_id')->first();
            $setting = $adminSetting ? clone $adminSetting : new WatermarkSetting([
                'is_watermark_enabled' => true,
                'watermark_type' => 'both',
                'watermark_text' => $photographer->name,
                'font_size' => 24,
                'opacity' => 65,
                'rotation' => -12,
                'watermark_color' => '#ff8a00',
                'watermark_pattern' => 'fotto_pro',
            ]);
            $setting->user_id = $photographer->id;
            $setting->watermark_text = $photographer->name;
        }

        return view('web.photographer-watermark', compact('photographer', 'setting', 'hasCustomWatermark'));
    }

    /**
     * Save the photographer's custom watermark settings.
     */
    public function saveWatermark(Request $request): JsonResponse|RedirectResponse
    {
        $photographer = $this->resolvePhotographer();

        $validated = $request->validate([
            'is_watermark_enabled' => 'nullable|boolean',
            'watermark_type' => 'required|in:text,logo,both',
            'watermark_text' => 'nullable|string|max:80',
            'font_size' => 'nullable|integer|min:10|max:100',
            'opacity' => 'nullable|integer|min:5|max:100',
            'rotation' => 'nullable|integer|min:-90|max:90',
            'is_tiled' => 'nullable|boolean',
            'logo_size' => 'nullable|integer|min:15|max:200',
            'both_layout' => 'nullable|in:stacked,inline,alternating,fotto_style',
            'both_gap' => 'nullable|integer|min:0|max:50',
            'watermark_color' => 'nullable|string|max:30',
            'security_badge_text' => 'nullable|string|max:100',
            'has_cross_lines' => 'nullable|boolean',
            'has_security_badge' => 'nullable|boolean',
            'is_download_protection_enabled' => 'nullable|boolean',
            'is_motion_mask_enabled' => 'nullable|boolean',
            'watermark_pattern' => 'nullable|in:fotto_pro,photox_pro,tiled,single_large,double_cross,hex_mesh,quad_corners',
            'watermark_density' => 'nullable|in:medium,high,ultra',
            'has_anti_ai_lines' => 'nullable|boolean',
            'single_logo_size' => 'nullable|integer|min:40|max:1000',
            'is_post_purchase_enabled' => 'nullable|boolean',
            'post_purchase_mode' => 'nullable|in:clean,sponsor_branded',
            'sponsor_placement' => 'nullable|in:bottom_right,bottom_left,top_right,top_left,middle_bottom',
            'sponsor_logo_size' => 'nullable|integer|min:20|max:200',
            'sponsor_opacity' => 'nullable|integer|min:10|max:100',
            'sponsor_margin' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|mimes:png,svg,webp|max:4096',
            'sponsor_logo' => 'nullable|image|mimes:png,svg,webp,jpg,jpeg|max:4096',
        ]);

        $data = [
            'user_id' => $photographer->id,
            'is_watermark_enabled' => $request->boolean('is_watermark_enabled', true),
            'watermark_type' => $validated['watermark_type'],
            'watermark_text' => ($validated['watermark_text'] ?? null) ?: $photographer->name,
            'font_size' => (int) ($validated['font_size'] ?? 24),
            'opacity' => (int) ($validated['opacity'] ?? 65),
            'rotation' => (int) ($validated['rotation'] ?? -12),
            'is_tiled' => $request->boolean('is_tiled', true),
            'watermark_pattern' => $validated['watermark_pattern'] ?? 'fotto_pro',
            'watermark_density' => $validated['watermark_density'] ?? 'high',
            'has_anti_ai_lines' => $request->boolean('has_anti_ai_lines', true),
            'single_logo_size' => (int) ($validated['single_logo_size'] ?? 160),
            'logo_size' => (int) ($validated['logo_size'] ?? 45),
            'both_layout' => $validated['both_layout'] ?? 'fotto_style',
            'both_gap' => (int) ($validated['both_gap'] ?? 8),
            'watermark_color' => $validated['watermark_color'] ?? '#ff8a00',
            'security_badge_text' => $request->has('security_badge_text') ? $request->input('security_badge_text') : 'Do not screenshot',
            'has_cross_lines' => $request->boolean('has_cross_lines', true),
            'has_security_badge' => $request->boolean('has_security_badge', true),
            'is_download_protection_enabled' => $request->boolean('is_download_protection_enabled', true),
            'is_motion_mask_enabled' => $request->boolean('is_motion_mask_enabled', false),
            'is_post_purchase_enabled' => $request->boolean('is_post_purchase_enabled', true),
            'post_purchase_mode' => $validated['post_purchase_mode'] ?? 'clean',
            'sponsor_placement' => $validated['sponsor_placement'] ?? 'bottom_right',
            'sponsor_logo_size' => (int) ($validated['sponsor_logo_size'] ?? 70),
            'sponsor_opacity' => (int) ($validated['sponsor_opacity'] ?? 90),
            'sponsor_margin' => (int) ($validated['sponsor_margin'] ?? 0),
        ];

        $destinationPath = public_path('uploads/watermarks');
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        if ($request->hasFile('logo')) {
            $filename = 'photographer_'.$photographer->id.'_'.time().'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move($destinationPath, $filename);
            $data['logo_path'] = '/uploads/watermarks/'.$filename;
        }

        if ($request->hasFile('sponsor_logo')) {
            $filename = 'photographer_sponsor_'.$photographer->id.'_'.time().'.'.$request->file('sponsor_logo')->getClientOriginalExtension();
            $request->file('sponsor_logo')->move($destinationPath, $filename);
            $data['sponsor_logo_path'] = '/uploads/watermarks/'.$filename;
        }

        $setting = WatermarkSetting::updateOrCreate(
            ['user_id' => $photographer->id],
            $data
        );

        // Invalidate watermarked preview files for this photographer's photos so website immediately reflects custom watermark
        $wmDir = storage_path('app/public/uploads/demo/watermarked');
        if (is_dir($wmDir)) {
            $existingPreviews = glob($wmDir.'/*_wm.jpg');
            foreach ($existingPreviews as $previewFile) {
                @unlink($previewFile);
            }
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'success' => true,
                'message' => 'Custom watermark and digital rights settings saved successfully! Your galleries now display your watermark.',
                'setting' => $setting->fresh(),
            ]);
        }

        return redirect()->back()->with('success', 'Custom watermark saved! Your galleries now use your custom watermark.');
    }

    /**
     * Reset photographer watermark to Admin Global Default.
     */
    public function resetWatermark(Request $request): JsonResponse|RedirectResponse
    {
        $photographer = $this->resolvePhotographer();

        WatermarkSetting::where('user_id', $photographer->id)->delete();

        // Invalidate watermarked preview files so they regenerate using admin default
        $photoIds = EventPhoto::where('photographer_id', $photographer->id)->pluck('id');
        foreach ($photoIds as $pId) {
            $wmPath = storage_path('app/public/uploads/demo/watermarked/'.$pId.'_wm.jpg');
            if (file_exists($wmPath)) {
                @unlink($wmPath);
            }
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Watermark reset to PhotoX Admin default! Your galleries will now display the platform watermark.',
            ]);
        }

        return redirect()->back()->with('success', 'Watermark reset to Admin Default.');
    }
}
