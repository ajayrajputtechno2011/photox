<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['category', 'photographer'])->latest('event_date');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('category_name', 'like', "%{$search}%")
                    ->orWhere('photographer_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category_name', $request->input('category'));
        }

        $events = $query->paginate(15);
        $totalEvents = Event::count();
        $publishedCount = Event::where('status', 'published')->count();
        $upcomingCount = Event::where('event_date', '>=', now()->toDateString())->count();
        $totalPhotos = Event::sum('total_photos');
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('admin.events', compact(
            'events',
            'totalEvents',
            'publishedCount',
            'upcomingCount',
            'totalPhotos',
            'categories'
        ));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $photographers = User::where('role', 'photographer')->orderBy('name')->get();

        return view('admin.add-event', compact('categories', 'photographers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'photographer_id' => 'nullable|exists:users,id',
            'sport' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'starting_price' => 'nullable|string|max:50',
            'total_photos' => 'nullable|integer',
            'photographers_count' => 'nullable|integer',
            'description' => 'nullable|string',
            'commercial_price' => 'nullable|numeric|min:0',
            'selfie_bundle_price' => 'nullable|numeric|min:0',
            'full_gallery_price' => 'nullable|numeric|min:0',
            'allow_individual_sales' => 'nullable|boolean',
            'cover_image' => 'nullable|string|max:1000',
            'cover_file' => 'nullable|image|max:10240',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:published,draft,archived',
        ]);

        $coverImage = $validated['cover_image'] ?? 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=900&q=80';
        if ($request->hasFile('cover_file')) {
            $path = $request->file('cover_file')->store('events', 'public');
            $fullDiskPath = storage_path('app/public/'.$path);
            if (file_exists($fullDiskPath)) {
                $this->optimizeCoverImage($fullDiskPath);
            }
            $coverImage = '/storage/'.$path;
        }

        $categoryName = $validated['sport'] ?? null;
        if (! empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            if ($cat) {
                $categoryName = $cat->name;
            }
        }

        $photographer = null;
        if (! empty($validated['photographer_id'])) {
            $photographer = User::find($validated['photographer_id']);
        }

        $slug = Str::slug($validated['title']);
        $baseSlug = $slug;
        $counter = 1;
        while (Event::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        Event::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'photographer_id' => $photographer?->id,
            'photographer_name' => $photographer?->name,
            'category_id' => $validated['category_id'] ?? null,
            'category_name' => $categoryName ?? 'Sport',
            'location' => $validated['location'],
            'event_date' => $validated['event_date'] ?? now()->toDateString(),
            'starting_price' => $validated['starting_price'] ?? 'From R90',
            'total_photos' => $validated['total_photos'] ?? 0,
            'photographers_count' => $validated['photographers_count'] ?? 1,
            'description' => $validated['description'] ?? null,
            'commercial_price' => $request->filled('commercial_price') ? (float) $request->input('commercial_price') : null,
            'selfie_bundle_price' => $request->filled('selfie_bundle_price') ? (float) $request->input('selfie_bundle_price') : null,
            'full_gallery_price' => $request->filled('full_gallery_price') ? (float) $request->input('full_gallery_price') : null,
            'allow_individual_sales' => $request->has('allow_individual_sales') ? $request->boolean('allow_individual_sales') : true,
            'cover_image' => $coverImage,
            'is_featured' => $request->has('is_featured'),
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully with assigned photographer watermark.');
    }

    public function edit(Event $event)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $photographers = User::where('role', 'photographer')->orderBy('name')->get();

        return view('admin.add-event', compact('event', 'categories', 'photographers'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'photographer_id' => 'nullable|exists:users,id',
            'sport' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'starting_price' => 'nullable|string|max:50',
            'total_photos' => 'nullable|integer',
            'photographers_count' => 'nullable|integer',
            'description' => 'nullable|string',
            'commercial_price' => 'nullable|numeric|min:0',
            'selfie_bundle_price' => 'nullable|numeric|min:0',
            'full_gallery_price' => 'nullable|numeric|min:0',
            'allow_individual_sales' => 'nullable|boolean',
            'cover_image' => 'nullable|string|max:1000',
            'cover_file' => 'nullable|image|max:10240',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:published,draft,archived',
        ]);

        $coverImage = $event->cover_image;
        $coverPhotoId = $event->cover_photo_id;
        if ($request->hasFile('cover_file')) {
            $path = $request->file('cover_file')->store('events', 'public');
            $fullDiskPath = storage_path('app/public/'.$path);
            if (file_exists($fullDiskPath)) {
                $this->optimizeCoverImage($fullDiskPath);
            }
            $coverImage = '/storage/'.$path;
            $coverPhotoId = null; // Specific cover uploaded: reset cover_photo_id so no watermark is applied
        } elseif (! empty($validated['cover_image']) && ! str_contains($validated['cover_image'], 'protected-photo')) {
            $coverImage = $validated['cover_image'];
            $coverPhotoId = null; // Specific cover URL entered: reset cover_photo_id
        }

        $categoryName = $validated['sport'] ?? $event->category_name;
        if (! empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            if ($cat) {
                $categoryName = $cat->name;
            }
        }

        $photographer = null;
        if (! empty($validated['photographer_id'])) {
            $photographer = User::find($validated['photographer_id']);
        }

        $oldPhotographerId = $event->photographer_id;

        $event->update([
            'title' => $validated['title'],
            'photographer_id' => $photographer?->id,
            'photographer_name' => $photographer?->name,
            'category_id' => $validated['category_id'] ?? null,
            'category_name' => $categoryName ?? 'Sport',
            'location' => $validated['location'],
            'event_date' => $validated['event_date'] ?? $event->event_date,
            'starting_price' => $validated['starting_price'] ?? $event->starting_price,
            'total_photos' => $validated['total_photos'] ?? $event->total_photos,
            'photographers_count' => $validated['photographers_count'] ?? $event->photographers_count,
            'description' => $validated['description'] ?? null,
            'commercial_price' => $request->filled('commercial_price') ? (float) $request->input('commercial_price') : null,
            'selfie_bundle_price' => $request->filled('selfie_bundle_price') ? (float) $request->input('selfie_bundle_price') : null,
            'full_gallery_price' => $request->filled('full_gallery_price') ? (float) $request->input('full_gallery_price') : null,
            'allow_individual_sales' => $request->has('allow_individual_sales') ? $request->boolean('allow_individual_sales') : true,
            'cover_image' => $coverImage,
            'cover_photo_id' => $coverPhotoId,
            'is_featured' => $request->has('is_featured'),
            'status' => $validated['status'],
        ]);

        // If photographer changed, invalidate cached watermarked preview images
        if ($oldPhotographerId !== ($photographer?->id)) {
            $photoIds = EventPhoto::where('event_id', $event->id)->pluck('id');
            foreach ($photoIds as $pId) {
                $wmPath = storage_path('app/public/uploads/demo/watermarked/'.$pId.'_wm.jpg');
                if (file_exists($wmPath)) {
                    @unlink($wmPath);
                }
            }
        }

        if ($event->status === 'published' && $event->photos()->count() > 0) {
            \App\Http\Controllers\Web\EventController::dispatchPendingEventNotifications($event);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    protected function optimizeCoverImage(string $fullPath): void
    {
        if (! file_exists($fullPath)) {
            return;
        }

        $info = @getimagesize($fullPath);
        if (! $info) {
            return;
        }

        $w = $info[0];
        $h = $info[1];
        $maxWidth = 1200;

        $im = null;
        if ($info['mime'] === 'image/jpeg' || $info['mime'] === 'image/jpg') {
            $im = @imagecreatefromjpeg($fullPath);
        } elseif ($info['mime'] === 'image/png') {
            $im = @imagecreatefrompng($fullPath);
        } elseif ($info['mime'] === 'image/webp') {
            $im = @imagecreatefromwebp($fullPath);
        }

        if (! $im) {
            return;
        }

        if ($w > $maxWidth) {
            $newW = $maxWidth;
            $newH = (int) round(($h / $w) * $maxWidth);
            $resized = imagecreatetruecolor($newW, $newH);
            imagecopyresampled($resized, $im, 0, 0, 0, 0, $newW, $newH, $w, $h);
            imagedestroy($im);
            imagejpeg($resized, $fullPath, 84);
            imagedestroy($resized);
        } else {
            imagejpeg($im, $fullPath, 84);
            imagedestroy($im);
        }
    }
}
