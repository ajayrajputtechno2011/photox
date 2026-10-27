<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CustomerSavedEvent;
use App\Models\CustomerSavedPhoto;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PhotoReport;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CustomerPortalController extends Controller
{
    /**
     * Resolve the active customer user.
     */
    protected function resolveCustomer(): User
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return User::where('role', 'customer')->first()
            ?: (User::first() ?: new User([
                'name' => 'Lebo Mokoena',
                'email' => 'lebo@example.com',
                'role' => 'customer',
            ]));
    }

    /**
     * Shopping Cart View.
     */
    public function cart(Request $request): View
    {
        // Clear any server‑side cart data after a purchase
        $request->session()->forget('cart');
        $request->session()->forget('cart_items');
        $user = Auth::user();

        // Retrieve persistent flag set by ordersDownloads (if any)
        $cartCleared = $request->session()->pull('cart_cleared', false);

        // Retrieve photo IDs that the user has already bought so they are automatically removed from cart
        $purchasedPhotoIds = [];
        if ($user) {
            $purchasedPhotoIds = $user->orderItems()
                ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
                ->pluck('event_photo_id')
                ->filter()
                ->values()
                ->toArray();
        }

        return view('web.cart', compact('user', 'cartCleared', 'purchasedPhotoIds'));
    }

    /**
     * Redirect photographers if they access customer dashboard or customer views.
     */
    protected function checkPhotographerAccess(): ?RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('info', 'Please sign in to access your customer dashboard.');
        }

        if (Auth::user()->role === 'photographer') {
            return redirect()->route('photographer.dashboard')->with('info', 'You are signed in as a Photographer. Here is your Creator Workspace.');
        }

        return null;
    }

    /**
     * Customer Overview Dashboard.
     */
    public function dashboard(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $user = Auth::user();

        // 1. Saved Photos (from customer_saved_photos table)
        $savedCount = $user->savedPhotos()->count();
        $savedPhotos = $user->savedPhotos()->with('event')->latest('customer_saved_photos.created_at')->take(6)->get();

        // Fallback showcase if user hasn't saved photos yet
        $samplePhotos = null;
        if ($savedPhotos->isEmpty()) {
            $samplePhotos = EventPhoto::with('event')->latest()->take(6)->get();
        }

        // 2. Followed Events (from customer_saved_events table)
        $eventsFollowedCount = $user->savedEvents()->count();
        $savedEvents = $user->savedEvents()->take(4)->get();
        $recentEvents = Event::where('status', 'published')->latest('event_date')->take(3)->get();

        // 3. Orders Placed & Downloads Ready (from orders & order_items tables)
        $ordersCount = $user->orders()->where('payment_status', 'completed')->count();
        $downloadsReady = $user->orderItems()->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))->count();

        return view('web.customer-dashboard', compact(
            'user',
            'savedPhotos',
            'samplePhotos',
            'savedEvents',
            'recentEvents',
            'savedCount',
            'ordersCount',
            'downloadsReady',
            'eventsFollowedCount'
        ));
    }

    /**
     * Customer Profile & Account Settings.
     */
    public function profileSettings(): View|RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('info', 'Please sign in to manage your profile settings.');
        }

        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $user = Auth::user();

        return view('web.profile-settings', compact('user'));
    }

    /**
     * Update customer profile and password.
     */
    public function updateProfileSettings(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login')->with('error', 'Please sign in to update your profile.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'location' => $request->input('location'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return back()->with('success', 'Profile and account details saved successfully!');
    }

    /**
     * Checkout page connecting cart items to Yoco Gateway.
     */
    public function checkout(Request $request): View|RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'))->with('info', 'Please sign in or create an account to proceed with your checkout and secure your purchased photos.');
        }

        $user = Auth::user();
        $publicKey = config('services.yoco.public_key', 'pk_test_51816363AVr2NXD875f4');

        return view('web.checkout', compact('user', 'publicKey'));
    }

    /**
     * Process order and initiate Yoco Payment Gateway checkout session.
     */
    public function processCheckout(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'amount' => ['required', 'numeric', 'min:0'],
            'cart_items' => ['nullable', 'string'],
        ]);

        $amountInRands = (float) $request->input('amount');
        $amountInCents = (int) round($amountInRands * 100);
        $customerEmail = $request->input('email');
        $customerName = trim($request->input('first_name').' '.$request->input('last_name'));
        $user = Auth::user();

        // Decode cart items JSON
        $cartItems = json_decode($request->input('cart_items', '[]'), true) ?: [];

        // Pre-create pending order with EXACT items selected in cart
        $order = Order::create([
            'order_number' => 'PX-'.date('Ymd').'-'.strtoupper(Str::random(5)),
            'user_id' => $user?->id,
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'total_amount' => $amountInRands,
            'currency' => 'ZAR',
            'payment_gateway' => 'yoco',
            'payment_status' => 'pending',
            'transaction_id' => null,
            'metadata' => [
                'items_count' => count($cartItems),
            ],
        ]);

        if (! empty($cartItems)) {
            foreach ($cartItems as $item) {
                $rawId = (string) ($item['id'] ?? '');
                $eventId = null;
                $photoId = null;

                if (str_starts_with($rawId, 'gallery_')) {
                    $eventId = (int) str_replace('gallery_', '', $rawId);
                } elseif (is_numeric($rawId)) {
                    $photoId = (int) $rawId;
                }

                $licenseType = $item['licenseType'] ?? ($item['license_type'] ?? 'personal');
                $isFullGallery = ($licenseType === 'full_gallery') || ! empty($item['is_complete_gallery']) || ! empty($eventId);

                $photo = $photoId ? EventPhoto::find($photoId) : null;
                if (! $eventId && $photo?->event_id) {
                    $eventId = $photo->event_id;
                }

                // If purchasing full complete gallery bundle, attach all photos from that event
                if ($isFullGallery && $eventId) {
                    $allEventPhotos = EventPhoto::where('event_id', $eventId)->get();
                    if ($allEventPhotos->isNotEmpty()) {
                        foreach ($allEventPhotos as $idx => $ePhoto) {
                            OrderItem::create([
                                'order_id' => $order->id,
                                'user_id' => $user?->id,
                                'event_photo_id' => $ePhoto->id,
                                'event_id' => $ePhoto->event_id,
                                'title' => $ePhoto->title ?: 'Gallery Photo #'.($idx + 1),
                                'price' => ($idx === 0) ? (float) ($item['price'] ?? 450.00) : 0.00,
                                'file_path' => $ePhoto->file_path,
                                'license_type' => 'full_gallery',
                            ]);
                        }

                        continue;
                    }
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => $user?->id,
                    'event_photo_id' => $photo?->id,
                    'event_id' => $photo?->event_id,
                    'title' => $photo?->title ?: ($item['title'] ?? 'Purchased Photo'),
                    'price' => (float) ($item['price'] ?? $photo?->personal_price ?? 75.00),
                    'file_path' => $photo?->file_path ?: ($item['image'] ?? null),
                    'license_type' => $licenseType,
                ]);
            }
        } elseif ($request->filled('photo_id')) {
            $photo = EventPhoto::find($request->input('photo_id'));
            $licenseType = $request->input('license_type', 'personal');

            if ($licenseType === 'full_gallery' && $photo?->event_id) {
                $allEventPhotos = EventPhoto::where('event_id', $photo->event_id)->get();
                if ($allEventPhotos->isNotEmpty()) {
                    foreach ($allEventPhotos as $idx => $ePhoto) {
                        OrderItem::create([
                            'order_id' => $order->id,
                            'user_id' => $user?->id,
                            'event_photo_id' => $ePhoto->id,
                            'event_id' => $ePhoto->event_id,
                            'title' => $ePhoto->title ?: 'Gallery Photo #'.($idx + 1),
                            'price' => ($idx === 0) ? $amountInRands : 0.00,
                            'file_path' => $ePhoto->file_path,
                            'license_type' => 'full_gallery',
                        ]);
                    }
                }
            } else {
                OrderItem::create([
                    'order_id' => $order->id,
                    'user_id' => $user?->id,
                    'event_photo_id' => $photo?->id,
                    'event_id' => $photo?->event_id,
                    'title' => $photo?->title ?: 'Purchased Photo',
                    'price' => (float) ($photo?->personal_price ?: $amountInRands),
                    'file_path' => $photo?->file_path,
                    'license_type' => $licenseType,
                ]);
            }
        }

        // If total is R0.00 (e.g. 100% coupon discount or free gallery), bypass Yoco payment gateway completely
        if ($amountInRands <= 0) {
            $order->update([
                'payment_status' => 'completed',
                'payment_gateway' => 'free_coupon',
                'transaction_id' => 'FREE-'.strtoupper(Str::random(10)),
            ]);

            return redirect()->to(url('/orders-downloads?status=success&order_id='.$order->id.'&amount=0.00&email='.urlencode($customerEmail)))
                ->with('success', 'Order completed successfully! Your photos are unlocked and ready to download.');
        }

        $secretKey = config('services.yoco.secret_key', 'sk_test_43f7c7607L9OKx8167446f29392a');

        try {
            $response = Http::withToken($secretKey)
                ->timeout(15)
                ->post('https://payments.yoco.com/api/checkouts', [
                    'amount' => $amountInCents,
                    'currency' => 'ZAR',
                    'cancelUrl' => url('/cart?payment=cancelled'),
                    'successUrl' => url('/orders-downloads?status=success&order_id='.$order->id.'&amount='.$amountInRands.'&email='.urlencode($customerEmail)),
                    'failureUrl' => url('/checkout?payment=failed'),
                    'metadata' => [
                        'order_id' => $order->id,
                        'customer_name' => $customerName,
                        'customer_email' => $customerEmail,
                        'source' => 'photox_web_cart',
                        'order_date' => now()->toIso8601String(),
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $redirectUrl = $data['redirectUrl'] ?? null;

                if ($redirectUrl) {
                    return redirect()->away($redirectUrl);
                }
            }

            $errorMessage = $response->json('errorMessage') ?: 'Unable to initiate Yoco payment checkout.';

            return back()->with('error', $errorMessage);
        } catch (\Exception $e) {
            Log::error('Yoco Checkout Error: '.$e->getMessage());

            return back()->with('error', 'Payment gateway error: '.$e->getMessage());
        }
    }

    /**
     * Orders & Downloads page.
     */
    public function ordersDownloads(Request $request): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $user = Auth::user();
        $status = $request->query('status');
        $amount = $request->query('amount');

        // If returned from a successful payment, mark order completed
        if ($status === 'success') {
            // Mark order as completed
            if ($request->filled('order_id')) {
                $order = Order::where('id', $request->input('order_id'))
                    ->where('user_id', $user->id)
                    ->first();

                if ($order && $order->payment_status !== 'completed') {
                    $order->update([
                        'payment_status' => 'completed',
                        'transaction_id' => $order->transaction_id ?: 'yoco_'.Str::random(12),
                    ]);
                }
            } elseif ($amount) {
                // Backward‑compatible fallback: find pending order for user
                $pendingOrder = Order::where('user_id', $user->id)
                    ->where('payment_status', 'pending')
                    ->latest()
                    ->first();

                if ($pendingOrder) {
                    $pendingOrder->update([
                        'payment_status' => 'completed',
                        'transaction_id' => $pendingOrder->transaction_id ?: 'yoco_'.Str::random(12),
                    ]);
                }
            }
            // Clear any server‑side cart data after successful payment
            $request->session()->forget('cart');
            $request->session()->forget('cart_items');
            $request->session()->forget('cart_cleared');
        }

        $purchasedPhotos = $user->orderItems()
            ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
            ->with(['photo.event', 'order'])
            ->latest()
            ->get();

        $orders = $user->orders()
            ->where('payment_status', 'completed')
            ->with(['items.photo.event'])
            ->latest('created_at')
            ->get();

        // Build sorted purchase groups (by Order / Date, newest first)
        $purchaseGroups = collect();

        if ($orders->isNotEmpty()) {
            foreach ($orders as $order) {
                $orderItems = $order->items;
                if ($orderItems->isNotEmpty()) {
                    $purchaseGroups->push((object) [
                        'type' => 'order',
                        'order_id' => $order->id,
                        'order_number' => $order->order_number,
                        'date' => $order->created_at ? $order->created_at->format('d M Y') : 'Recent',
                        'raw_date' => $order->created_at ? $order->created_at->format('Y-m-d') : '',
                        'time' => $order->created_at ? $order->created_at->format('H:i') : '',
                        'items_count' => $orderItems->count(),
                        'total_amount' => $order->total_amount,
                        'items' => $orderItems,
                        'download_zip_url' => route('orders.download.zip', ['order_id' => $order->id]),
                    ]);
                }
            }
        }

        // Include any order items not tied to an order (e.g. legacy/direct records)
        $orderItemIdsHandled = $orders->flatMap->items->pluck('id')->toArray();
        $unlinkedItems = $purchasedPhotos->whereNotIn('id', $orderItemIdsHandled);
        if ($unlinkedItems->isNotEmpty()) {
            $unlinkedByDate = $unlinkedItems->groupBy(function ($item) {
                return $item->created_at ? $item->created_at->format('Y-m-d') : 'Recent';
            });
            foreach ($unlinkedByDate as $dateKey => $items) {
                $firstItem = $items->first();
                $formattedDate = $firstItem->created_at ? $firstItem->created_at->format('d M Y') : 'Recent';
                $purchaseGroups->push((object) [
                    'type' => 'date',
                    'order_id' => null,
                    'order_number' => null,
                    'date' => $formattedDate,
                    'raw_date' => $dateKey,
                    'time' => $firstItem->created_at ? $firstItem->created_at->format('H:i') : '',
                    'items_count' => $items->count(),
                    'total_amount' => $items->sum('price'),
                    'items' => $items,
                    'download_zip_url' => route('orders.download.zip', ['date' => $dateKey]),
                ]);
            }
        }

        // Fallback: If purchaseGroups is empty but purchasedPhotos has items, group purchasedPhotos by date
        if ($purchaseGroups->isEmpty() && $purchasedPhotos->isNotEmpty()) {
            $byDate = $purchasedPhotos->groupBy(function ($item) {
                return $item->created_at ? $item->created_at->format('Y-m-d') : 'Recent';
            });
            foreach ($byDate as $dateKey => $items) {
                $firstItem = $items->first();
                $formattedDate = $firstItem->created_at ? $firstItem->created_at->format('d M Y') : 'Recent';
                $purchaseGroups->push((object) [
                    'type' => 'date',
                    'order_id' => null,
                    'order_number' => null,
                    'date' => $formattedDate,
                    'raw_date' => $dateKey,
                    'time' => $firstItem->created_at ? $firstItem->created_at->format('H:i') : '',
                    'items_count' => $items->count(),
                    'total_amount' => $items->sum('price'),
                    'items' => $items,
                    'download_zip_url' => route('orders.download.zip', ['date' => $dateKey]),
                ]);
            }
        }

        $samplePhotos = null;

        return view('web.orders-downloads', compact('user', 'status', 'amount', 'purchasedPhotos', 'samplePhotos', 'orders', 'purchaseGroups'));
    }

    /**
     * Download bundled original photos as a ZIP archive.
     */
    public function downloadZip(Request $request)
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $user = Auth::user();

        $orderId = $request->input('order_id');
        $dateParam = $request->input('date');
        $photoIds = $request->input('photos');

        $zipFileName = 'PhotoX_Purchased_Photos_'.date('Ymd_His').'.zip';

        if ($orderId) {
            $order = Order::where('id', $orderId)
                ->where('user_id', $user->id)
                ->where('payment_status', 'completed')
                ->firstOrFail();

            $orderPhotoIds = $order->items()->pluck('event_photo_id')->filter()->unique()->toArray();

            $galleryEventIds = $order->items()
                ->where(function ($q) {
                    $q->where('license_type', 'full_gallery')
                        ->orWhere('title', 'LIKE', '%Complete Gallery%');
                })
                ->pluck('event_id')
                ->filter()
                ->unique()
                ->toArray();

            if (! empty($galleryEventIds)) {
                $extraIds = EventPhoto::whereIn('event_id', $galleryEventIds)->pluck('id')->toArray();
                $orderPhotoIds = array_unique(array_merge($orderPhotoIds, $extraIds));
            }

            $photos = EventPhoto::whereIn('id', $orderPhotoIds)->get();
            $zipFileName = 'PhotoX_Order_'.$order->order_number.'_'.($order->created_at ? $order->created_at->format('Ymd') : date('Ymd')).'.zip';
        } elseif ($dateParam) {
            $datePhotoIds = $user->orderItems()
                ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
                ->whereDate('created_at', $dateParam)
                ->pluck('event_photo_id')
                ->filter()
                ->unique()
                ->toArray();

            $galleryEventIds = $user->orderItems()
                ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
                ->whereDate('created_at', $dateParam)
                ->where(function ($q) {
                    $q->where('license_type', 'full_gallery')
                        ->orWhere('title', 'LIKE', '%Complete Gallery%');
                })
                ->pluck('event_id')
                ->filter()
                ->unique()
                ->toArray();

            if (! empty($galleryEventIds)) {
                $extraIds = EventPhoto::whereIn('event_id', $galleryEventIds)->pluck('id')->toArray();
                $datePhotoIds = array_unique(array_merge($datePhotoIds, $extraIds));
            }

            $photos = EventPhoto::whereIn('id', $datePhotoIds)->get();
            $zipFileName = 'PhotoX_Purchases_'.str_replace('-', '', $dateParam).'.zip';
        } elseif ($photoIds) {
            $ids = is_array($photoIds) ? $photoIds : explode(',', $photoIds);
            // Must strictly only allow photos that the user has completed orders for!
            $allowedPhotoIds = $user->orderItems()
                ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
                ->whereIn('event_photo_id', $ids)
                ->pluck('event_photo_id')
                ->toArray();

            $galleryEventIds = $user->orderItems()
                ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
                ->where(function ($q) {
                    $q->where('license_type', 'full_gallery')
                        ->orWhere('title', 'LIKE', '%Complete Gallery%');
                })
                ->pluck('event_id')
                ->filter()
                ->unique()
                ->toArray();

            if (! empty($galleryEventIds)) {
                $extraIds = EventPhoto::whereIn('event_id', $galleryEventIds)->whereIn('id', $ids)->pluck('id')->toArray();
                $allowedPhotoIds = array_unique(array_merge($allowedPhotoIds, $extraIds));
            }

            $photos = EventPhoto::whereIn('id', $allowedPhotoIds)->get();
        } else {
            // Get from user's completed purchased photos
            $userPhotoIds = $user->orderItems()
                ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
                ->pluck('event_photo_id')
                ->filter()
                ->unique()
                ->toArray();

            $galleryEventIds = $user->orderItems()
                ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
                ->where(function ($q) {
                    $q->where('license_type', 'full_gallery')
                        ->orWhere('title', 'LIKE', '%Complete Gallery%');
                })
                ->pluck('event_id')
                ->filter()
                ->unique()
                ->toArray();

            if (! empty($galleryEventIds)) {
                $extraIds = EventPhoto::whereIn('event_id', $galleryEventIds)->pluck('id')->toArray();
                $userPhotoIds = array_unique(array_merge($userPhotoIds, $extraIds));
            }

            if (! empty($userPhotoIds)) {
                $photos = EventPhoto::whereIn('id', $userPhotoIds)->get();
            } else {
                $photos = collect();
            }
        }

        if ($photos->isEmpty()) {
            return back()->with('error', 'No purchased photos available for download. Please purchase photos first.');
        }

        $zipFileName = 'PhotoX_Purchased_Photos_'.date('Ymd_His').'.zip';
        $tempDir = storage_path('app/temp_zips');
        if (! file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        $zipFilePath = $tempDir.'/'.$zipFileName;

        $zip = new \ZipArchive;
        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return back()->with('error', 'Unable to create ZIP archive on server.');
        }

        $addedCount = 0;
        foreach ($photos as $idx => $photo) {
            $localPath = public_path(ltrim($photo->file_path, '/'));
            $entryName = ($photo->title ? Str::slug($photo->title) : 'photo_'.$photo->id).'_'.($idx + 1).'.jpg';

            if (file_exists($localPath) && is_file($localPath)) {
                $zip->addFile($localPath, $entryName);
                $addedCount++;
            } elseif (filter_var($photo->file_path, FILTER_VALIDATE_URL)) {
                try {
                    $content = @file_get_contents($photo->file_path);
                    if ($content) {
                        $zip->addFromString($entryName, $content);
                        $addedCount++;
                    }
                } catch (\Exception $e) {
                }
            }
        }

        $zip->close();

        if (! file_exists($zipFilePath) || filesize($zipFilePath) === 0 || $addedCount === 0) {
            @unlink($zipFilePath);

            return back()->with('error', 'Could not assemble high-resolution photos into archive.');
        }

        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    }

    /**
     * Force-download a single purchased unwatermarked photo.
     */
    public function downloadSinglePhoto(int|string $id)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $user = Auth::user();

        // Find the OrderItem belonging to user with completed payment
        $orderItem = $user->orderItems()
            ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
            ->where(function ($q) use ($id) {
                $q->where('id', $id)->orWhere('event_photo_id', $id);
            })
            ->first();

        $filePath = null;
        $cleanTitle = 'Photo';
        $photoId = $id;

        if (! $orderItem) {
            $photo = EventPhoto::find($id);
            if ($photo && $photo->event_id) {
                $hasGalleryOrder = $user->orderItems()
                    ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
                    ->where(function ($q) {
                        $q->where('license_type', 'full_gallery')
                            ->orWhere('title', 'LIKE', '%Complete Gallery%');
                    })
                    ->where('event_id', $photo->event_id)
                    ->exists();

                if ($hasGalleryOrder) {
                    $filePath = $photo->file_path;
                    $cleanTitle = $photo->title ? Str::slug($photo->title) : 'Photo';
                    $photoId = $photo->id;
                }
            }

            if (! $filePath) {
                return back()->with('error', 'You have not purchased this photo or access has expired.');
            }
        } else {
            $filePath = $orderItem->file_path;
            $photoId = $orderItem->photo?->id ?? $orderItem->event_photo_id ?? $id;
            $cleanTitle = $orderItem->title ? Str::slug($orderItem->title) : 'Photo';
        }

        $fileName = 'PhotoX_'.$photoId.'_'.$cleanTitle.'.jpg';

        // 1. Local file on server disk
        $localPath = public_path(ltrim($filePath, '/'));
        if (file_exists($localPath) && is_file($localPath)) {
            return response()->download($localPath, $fileName, [
                'Content-Type' => 'image/jpeg',
            ]);
        }

        // 2. Remote URL (R2, S3, or CDN) -> Stream as attachment download
        if (filter_var($filePath, FILTER_VALIDATE_URL)) {
            try {
                $response = Http::timeout(30)->get($filePath);
                if ($response->successful()) {
                    return response($response->body(), 200, [
                        'Content-Type' => 'image/jpeg',
                        'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
                        'Cache-Control' => 'no-cache, must-revalidate',
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Download photo stream error: '.$e->getMessage());
            }
        }

        // Fallback: direct download redirect
        return redirect()->away($filePath);
    }

    /**
     * My Photos customer gallery.
     */
    public function myPhotos(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $user = Auth::user();
        $savedCount = $user->savedPhotos()->count();
        $photos = $user->savedPhotos()->with('event')->latest('customer_saved_photos.created_at')->paginate(12);

        // Fetch user's purchased clean photos (including full galleries)
        $purchasedPhotoIds = $user->orderItems()
            ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
            ->pluck('event_photo_id')
            ->filter()
            ->unique()
            ->toArray();

        $galleryEventIds = $user->orderItems()
            ->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))
            ->where(function ($q) {
                $q->where('license_type', 'full_gallery')
                    ->orWhere('title', 'LIKE', '%Complete Gallery%');
            })
            ->pluck('event_id')
            ->filter()
            ->unique()
            ->toArray();

        if (! empty($galleryEventIds)) {
            $extraIds = EventPhoto::whereIn('event_id', $galleryEventIds)->pluck('id')->toArray();
            $purchasedPhotoIds = array_unique(array_merge($purchasedPhotoIds, $extraIds));
        }

        $purchasedPhotos = ! empty($purchasedPhotoIds)
            ? EventPhoto::whereIn('id', $purchasedPhotoIds)->with('event')->latest()->get()
            : collect();

        $samplePhotos = null;
        if ($photos->isEmpty() && $purchasedPhotos->isEmpty()) {
            $samplePhotos = EventPhoto::with('event')->latest()->take(12)->get();
        }

        return view('web.my-photos', compact('user', 'photos', 'samplePhotos', 'savedCount', 'purchasedPhotos'));
    }

    /**
     * Saved / Bookmarked Events.
     */
    public function savedEvents(): View|RedirectResponse
    {
        if ($redirect = $this->checkPhotographerAccess()) {
            return $redirect;
        }

        $user = Auth::user();
        $events = $user->savedEvents()->latest('customer_saved_events.created_at')->paginate(10);

        $suggestedEvents = null;
        if ($events->isEmpty()) {
            $suggestedEvents = Event::where('status', 'published')->latest('event_date')->take(6)->get();
        }

        return view('web.saved-events', compact('user', 'events', 'suggestedEvents'));
    }

    /**
     * AJAX/API Toggle bookmark for a photo.
     */
    public function toggleSavePhoto(int $photoId): JsonResponse
    {
        if (! Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please sign in to save photos.'], 401);
        }

        $user = Auth::user();
        $existing = CustomerSavedPhoto::where('user_id', $user->id)->where('event_photo_id', $photoId)->first();

        if ($existing) {
            $existing->delete();

            return response()->json([
                'success' => true,
                'saved' => false,
                'count' => $user->savedPhotos()->count(),
                'message' => 'Photo removed from saved.',
            ]);
        }

        CustomerSavedPhoto::create([
            'user_id' => $user->id,
            'event_photo_id' => $photoId,
        ]);

        return response()->json([
            'success' => true,
            'saved' => true,
            'count' => $user->savedPhotos()->count(),
            'message' => 'Photo saved to your vault!',
        ]);
    }

    /**
     * AJAX/API Toggle follow for an event.
     */
    public function toggleSaveEvent(int $eventId): JsonResponse
    {
        if (! Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please sign in to follow events.'], 401);
        }

        $user = Auth::user();
        $existing = CustomerSavedEvent::where('user_id', $user->id)->where('event_id', $eventId)->first();

        if ($existing) {
            $existing->delete();

            return response()->json([
                'success' => true,
                'saved' => false,
                'count' => $user->savedEvents()->count(),
                'message' => 'Event unfollowed.',
            ]);
        }

        CustomerSavedEvent::create([
            'user_id' => $user->id,
            'event_id' => $eventId,
        ]);

        return response()->json([
            'success' => true,
            'saved' => true,
            'count' => $user->savedEvents()->count(),
            'message' => 'Event saved to your followed list!',
        ]);
    }

    /**
     * AJAX/API Flag / Report a photo for review.
     */
    public function flagPhoto(Request $request, int $photoId): JsonResponse
    {
        $request->validate([
            'reason' => ['required', 'string', 'max:255'],
            'details' => ['nullable', 'string', 'max:1000'],
        ]);

        $photo = EventPhoto::find($photoId);
        if (! $photo) {
            return response()->json(['success' => false, 'message' => 'Photo not found.'], 404);
        }

        $userId = Auth::id();
        $ip = $request->ip();

        PhotoReport::create([
            'user_id' => $userId,
            'event_photo_id' => $photo->id,
            'reason' => $request->input('reason'),
            'details' => $request->input('details'),
            'status' => 'pending',
            'ip_address' => $ip,
        ]);

        return response()->json([
            'success' => true,
            'flagged' => true,
            'photo_id' => $photo->id,
            'message' => 'Photo #'.$photo->id.' has been reported for review. Thank you for keeping PhotoX safe.',
        ]);
    }

    /**
     * Validate and calculate coupon discount / volume bundles at checkout.
     */
    public function validateCoupon(Request $request): JsonResponse
    {
        $code = strtoupper(trim($request->input('code', '')));
        $itemCount = (int) $request->input('item_count', 1);
        $subtotal = (float) $request->input('subtotal', 0.00);

        // Auto volume bundle check if code is empty or checking for volume
        if (empty($code)) {
            if ($itemCount >= 5) {
                $bundleCoupon = Coupon::where('type', 'bundle_volume')
                    ->where('is_active', true)
                    ->where('min_items', '<=', $itemCount)
                    ->orderByDesc('discount_value')
                    ->first();

                if ($bundleCoupon) {
                    $discount = $bundleCoupon->calculateDiscount($itemCount, $subtotal);
                    $finalTotal = max(0.00, $subtotal - $discount);

                    return response()->json([
                        'valid' => true,
                        'is_auto_bundle' => true,
                        'code' => $bundleCoupon->code,
                        'title' => $bundleCoupon->title,
                        'type' => $bundleCoupon->type,
                        'discount_amount' => $discount,
                        'discount_formatted' => 'R '.number_format($discount, 2),
                        'final_total' => $finalTotal,
                        'final_formatted' => 'R '.number_format($finalTotal, 2),
                        'message' => "🎉 Volume Bundle Applied: {$bundleCoupon->title} (Saved R ".number_format($discount, 2).')',
                    ]);
                }
            }

            return response()->json([
                'valid' => false,
                'message' => 'Please enter a coupon code.',
            ], 422);
        }

        $coupon = Coupon::where('code', $code)->first();

        if (! $coupon) {
            return response()->json([
                'valid' => false,
                'message' => "Coupon code '{$code}' was not found.",
            ], 404);
        }

        if (! $coupon->is_active) {
            return response()->json([
                'valid' => false,
                'message' => 'This promo coupon is currently inactive.',
            ], 422);
        }

        if ($coupon->expires_at && $coupon->expires_at->isPast()) {
            return response()->json([
                'valid' => false,
                'message' => 'This promo code has expired.',
            ], 422);
        }

        if ($coupon->max_uses !== null && $coupon->used_count >= $coupon->max_uses) {
            return response()->json([
                'valid' => false,
                'message' => 'This promo code has reached its maximum redemptions.',
            ], 422);
        }

        if ($coupon->min_items > 0 && $itemCount < $coupon->min_items) {
            return response()->json([
                'valid' => false,
                'message' => "This coupon requires a minimum of {$coupon->min_items} photos in your cart.",
            ], 422);
        }

        if ($coupon->min_order_amount > 0 && $subtotal < (float) $coupon->min_order_amount) {
            return response()->json([
                'valid' => false,
                'message' => 'This coupon requires a minimum cart total of R '.number_format($coupon->min_order_amount, 2).'.',
            ], 422);
        }

        $discountAmount = $coupon->calculateDiscount($itemCount, $subtotal);
        $finalTotal = max(0.00, $subtotal - $discountAmount);

        return response()->json([
            'valid' => true,
            'code' => $coupon->code,
            'title' => $coupon->title,
            'type' => $coupon->type,
            'discount_amount' => $discountAmount,
            'discount_formatted' => 'R '.number_format($discountAmount, 2),
            'final_total' => $finalTotal,
            'final_formatted' => 'R '.number_format($finalTotal, 2),
            'message' => "Coupon '{$coupon->code}' applied successfully! Saved R ".number_format($discountAmount, 2),
        ]);
    }
}
