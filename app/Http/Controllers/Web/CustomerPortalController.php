<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\User;
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
        $user = $this->resolveCustomer();

        return view('web.cart', compact('user'));
    }

    /**
     * Redirect photographers if they access customer dashboard.
     */
    protected function checkPhotographerAccess(): ?RedirectResponse
    {
        if (Auth::check() && Auth::user()->role === 'photographer') {
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

        $user = $this->resolveCustomer();

        $savedPhotos = EventPhoto::with('event')->latest()->take(6)->get();
        $recentEvents = Event::where('status', 'published')->latest('event_date')->take(3)->get();

        $savedCount = count($savedPhotos);
        $ordersCount = 3;
        $downloadsReady = max(4, count($savedPhotos));

        return view('web.customer-dashboard', compact(
            'user',
            'savedPhotos',
            'recentEvents',
            'savedCount',
            'ordersCount',
            'downloadsReady'
        ));
    }

    /**
     * Customer Profile & Account Settings.
     */
    public function profileSettings(): View
    {
        $user = $this->resolveCustomer();

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
            'amount' => ['required', 'numeric', 'min:1'],
            'cart_items' => ['nullable', 'string'],
        ]);

        $amountInRands = (float) $request->input('amount');
        $amountInCents = (int) round($amountInRands * 100);
        $customerEmail = $request->input('email');
        $customerName = trim($request->input('first_name').' '.$request->input('last_name'));

        $secretKey = config('services.yoco.secret_key', 'sk_test_43f7c7607L9OKx8167446f29392a');

        try {
            $response = Http::withToken($secretKey)
                ->timeout(15)
                ->post('https://payments.yoco.com/api/checkouts', [
                    'amount' => $amountInCents,
                    'currency' => 'ZAR',
                    'cancelUrl' => url('/cart?payment=cancelled'),
                    'successUrl' => url('/orders-downloads?status=success&amount='.$amountInRands.'&email='.urlencode($customerEmail)),
                    'failureUrl' => url('/checkout?payment=failed'),
                    'metadata' => [
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
    public function ordersDownloads(Request $request): View
    {
        $user = $this->resolveCustomer();
        $status = $request->query('status');
        $amount = $request->query('amount');

        $purchasedPhotos = EventPhoto::with('event')->latest()->take(8)->get();

        return view('web.orders-downloads', compact('user', 'status', 'amount', 'purchasedPhotos'));
    }

    /**
     * Download bundled original photos as a ZIP archive.
     */
    public function downloadZip(Request $request)
    {
        $user = $this->resolveCustomer();

        $photoIds = $request->input('photos');
        if ($photoIds) {
            $ids = is_array($photoIds) ? $photoIds : explode(',', $photoIds);
            $photos = EventPhoto::whereIn('id', $ids)->get();
        } else {
            $photos = EventPhoto::latest()->take(8)->get();
        }

        if ($photos->isEmpty()) {
            return back()->with('error', 'No photos available for download.');
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
     * My Photos customer gallery.
     */
    public function myPhotos(): View
    {
        $user = $this->resolveCustomer();
        $photos = EventPhoto::with('event')->latest()->take(12)->get();

        return view('web.my-photos', compact('user', 'photos'));
    }

    /**
     * Saved / Bookmarked Events.
     */
    public function savedEvents(): View
    {
        $user = $this->resolveCustomer();
        $events = Event::where('status', 'published')->latest('event_date')->take(6)->get();

        return view('web.saved-events', compact('user', 'events'));
    }
}
