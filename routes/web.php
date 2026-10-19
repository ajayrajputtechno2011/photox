<?php

use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\LegalPageController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\MembershipController as AdminMembershipController;
use App\Http\Controllers\Admin\PageBannerController as AdminPageBannerController;
use App\Http\Controllers\Admin\PhotographerController as AdminPhotographerController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\WatermarkController;
use App\Http\Controllers\Admin\WatermarkController as AdminWatermarkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Web\CustomerPortalController;
use App\Http\Controllers\Web\EmailVerificationController;
use App\Http\Controllers\Web\EventController as WebEventController;
use App\Http\Controllers\Web\LegalController;
use App\Http\Controllers\Web\MembershipController as WebMembershipController;
use App\Http\Controllers\Web\PhotographerController as WebPhotographerController;
use App\Http\Controllers\Web\PhotographerPortalController;
use App\Http\Controllers\Web\YocoTestController;
use App\Models\User;
use App\Models\WatermarkSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home page (Direct clean Events & Galleries Marketplace as requested by client)
Route::get('/', [WebEventController::class, 'index'])->name('home');
Route::get('/home', [WebEventController::class, 'index'])->name('home.preview');
Route::get('/home-showcase', [DemoController::class, 'dummyHome'])->name('home.showcase');
Route::get('/api/load-more-photos', [DemoController::class, 'apiLoadMorePhotos'])->name('api.photos.loadMore');

// Dynamic Explore & Events routes
Route::get('/events', [WebEventController::class, 'index'])->name('events.index');
Route::get('/events.html', function () {
    return redirect('/events', 301);
});
Route::get('/event-details', [WebEventController::class, 'show'])->name('events.details');
Route::get('/event-details/{slug}', [WebEventController::class, 'show'])->name('events.show');
Route::get('/event-details.html', function () {
    return redirect('/event-details', 301);
});

// Dynamic Membership route
Route::get('/membership', [WebMembershipController::class, 'index'])->name('membership');
Route::get('/membership.html', function () {
    return redirect('/membership', 301);
});

// News, Articles & Journal
Route::get('/news', function () {
    return view('web.blog');
})->name('news');
Route::get('/news.html', fn () => redirect('/news', 301));
Route::get('/blog', fn () => redirect('/news', 301))->name('blog');
Route::get('/blog.html', fn () => redirect('/news', 301));
Route::get('/journal', fn () => redirect('/news', 301));
Route::get('/journal.html', fn () => redirect('/news', 301));

// About & Contact pages
Route::get('/about', function () {
    return view('web.about');
})->name('about');
Route::get('/about.html', fn () => redirect('/about', 301));

Route::get('/contact', function () {
    return view('web.contact');
})->name('contact');
Route::get('/contact.html', fn () => redirect('/contact', 301));

// Legal & POPIA Compliance Policies
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
Route::get('/terms-and-conditions', fn () => redirect('/terms', 301));
Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
Route::get('/privacy-policy', fn () => redirect('/privacy', 301));
Route::get('/licensing', [LegalController::class, 'licensing'])->name('licensing');
Route::get('/legal/{slug}', [LegalController::class, 'show'])->name('legal.show');

// Dynamic Photographers directory & details routes
Route::get('/photographers', [WebPhotographerController::class, 'index'])->name('photographers.index');
Route::get('/photographers.html', fn () => redirect('/photographers', 301));
Route::get('/photographer-details', [WebPhotographerController::class, 'show'])->name('photographers.details');
Route::get('/photographer-details/{id}', [WebPhotographerController::class, 'show'])->name('photographers.show');
Route::get('/photographer-details.html', function () {
    return redirect('/photographer-details', 301);
});
Route::get('/@{username}', [WebPhotographerController::class, 'show'])->name('photographers.at_username');
Route::get('/{username}', [WebPhotographerController::class, 'show'])
    ->where('username', '^(aidendaniels|jordanmiller|sarahkim|michaeladams|siphodlamini|danieljacobs|aiden-daniels|jordan-miller|sarah-kim|michael-adams|sipho-dlamini|daniel-jacobs)$')
    ->name('photographers.vanity');

// Dynamic Photographer Portal routes (Dashboard, Upload, Galleries, Profile, Earnings, Bookings)
Route::get('/photographer-dashboard', [PhotographerPortalController::class, 'dashboard'])->name('photographer.dashboard');
Route::get('/photographer-upload-new', [PhotographerPortalController::class, 'uploadForm'])->name('photographer.upload');
Route::post('/photographer-upload-new', [PhotographerPortalController::class, 'storeGallery'])->name('photographer.upload.store');
Route::get('/photographer-gallery', [PhotographerPortalController::class, 'galleries'])->name('photographer.gallery');
Route::post('/photographer-gallery/{id}/update', [PhotographerPortalController::class, 'updateGallery'])->name('photographer.gallery.update');
Route::post('/photographer-gallery/{id}/upload-photos', [PhotographerPortalController::class, 'uploadMorePhotos'])->name('photographer.gallery.upload_photos');
Route::delete('/photographer-gallery/photo/{id}', [PhotographerPortalController::class, 'deletePhoto'])->name('photographer.gallery.photo.delete');
Route::post('/photographer-gallery/photo/{id}/set-cover', [PhotographerPortalController::class, 'setCoverPhoto'])->name('photographer.gallery.photo.cover');
Route::delete('/photographer-gallery/{id}', [PhotographerPortalController::class, 'destroyGallery'])->name('photographer.gallery.destroy');
Route::get('/photographer-watermark', [PhotographerPortalController::class, 'watermarkStudio'])->name('photographer.watermark');
Route::post('/photographer-watermark/save', [PhotographerPortalController::class, 'saveWatermark'])->name('photographer.watermark.save');
Route::post('/photographer-watermark/reset', [PhotographerPortalController::class, 'resetWatermark'])->name('photographer.watermark.reset');
Route::get('/photographer-profile', [PhotographerPortalController::class, 'profile'])->name('photographer.profile');
Route::post('/photographer-profile', [PhotographerPortalController::class, 'updateProfile'])->name('photographer.profile.update');
Route::get('/photographer-earnings', [PhotographerPortalController::class, 'earnings'])->name('photographer.earnings');
Route::get('/photographer-bookings', [PhotographerPortalController::class, 'bookings'])->name('photographer.bookings');
Route::get('/photographer-payouts', [PhotographerPortalController::class, 'payouts'])->name('photographer.payouts');
Route::post('/photographer-payouts', [PhotographerPortalController::class, 'updatePayouts'])->name('photographer.payouts.update');

// Dynamic Customer Portal routes (Cart, Dashboard, Profile, Checkout, Orders, Saved, My Photos)
Route::get('/cart', [CustomerPortalController::class, 'cart'])->name('cart');
Route::get('/customer-dashboard', [CustomerPortalController::class, 'dashboard'])->name('customer.dashboard');
Route::get('/profile-settings', [CustomerPortalController::class, 'profileSettings'])->name('customer.profile');
Route::post('/profile-settings', [CustomerPortalController::class, 'updateProfileSettings'])->name('customer.profile.update');
Route::get('/checkout', [CustomerPortalController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [CustomerPortalController::class, 'processCheckout'])->name('checkout.process');
Route::get('/orders-downloads', [CustomerPortalController::class, 'ordersDownloads'])->name('orders.downloads');
Route::get('/orders-downloads/download-zip', [CustomerPortalController::class, 'downloadZip'])->name('orders.download.zip');
Route::get('/orders-downloads/download-single/{id}', [CustomerPortalController::class, 'downloadSinglePhoto'])->name('orders.download.single');
Route::get('/my-photos', [CustomerPortalController::class, 'myPhotos'])->name('customer.my_photos');
Route::get('/saved-events', [CustomerPortalController::class, 'savedEvents'])->name('customer.saved_events');
Route::post('/api/photos/{id}/toggle-save', [CustomerPortalController::class, 'toggleSavePhoto'])->name('customer.photo.toggle_save');
Route::post('/api/events/{id}/toggle-save', [CustomerPortalController::class, 'toggleSaveEvent'])->name('customer.event.toggle_save');
Route::post('/api/photos/{id}/flag', [CustomerPortalController::class, 'flagPhoto'])->name('customer.photo.flag');

// Public demo links show "Work in Progress"
Route::get('/watermark-studio-demo', function () {
    return view('demo.work-in-progress');
})->name('watermark.studio.demo');

Route::get('/dummy', function () {
    return view('demo.work-in-progress');
});

Route::get('/dummy-photographer-details', function () {
    return view('demo.photographer-details');
})->name('dummy.photographer.details');

Route::get('/dummy-event-gallery/{slug?}', [DemoController::class, 'dummyEventShow'])->name('dummy.event.gallery');
Route::get('/event-gallery-demo', [DemoController::class, 'dummyEventShow'])->name('demo.event.gallery');

// Yoco Payment Gateway Sandbox Testing Route
Route::get('/yoco-test', [YocoTestController::class, 'index'])->name('yoco.test');
Route::post('/yoco/create-checkout', [YocoTestController::class, 'createCheckout'])->name('yoco.checkout.create');
Route::post('/yoco/charge-token', [YocoTestController::class, 'chargeToken'])->name('yoco.charge.token');

// Dedicated Public Frontend Sandbox Dummy Home (Does not touch live home)
Route::get('/dummy-home_testing', [DemoController::class, 'dummyHome'])->name('dummy.home');
Route::get('/dummy-home', function () {
    return response('<!DOCTYPE html><html><head><meta charset="utf-8"><title>No Data</title></head><body style="margin:0;display:flex;align-items:center;justify-content:center;height:100vh;background:#0d1117;color:#8b949e;font-family:sans-serif;font-size:1.6rem;font-weight:600;">No Data</body></html>', 200)
        ->header('Content-Type', 'text/html');
});
Route::any('/dummy-event', function () {
    abort(404);
});
Route::any('/dummy-event/{any}', function () {
    abort(404);
})->where('any', '.*');
Route::get('/protected-photo/{id}', [DemoController::class, 'protectedImage'])->name('demo.photo.protected');
Route::get('/protected-photo/{id}.jpg', [DemoController::class, 'protectedImage']);

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login.html', [AuthController::class, 'showLoginForm']);
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
    Route::get('/signup.html', [AuthController::class, 'showSignupForm']);
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// POPIA Email Verification Routes
Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::redirect('/index.html', '/admin/login', 301);
    Route::redirect('/dashboard.html', '/admin/dashboard', 301);

    Route::get('/{page}.html', function ($page) {
        return redirect('/admin/'.$page, 301);
    })->where('page', '^[a-zA-Z0-9_\-]+$');

    // Admin Login (Public for guests; redirects logged-in admin to dashboard)
    Route::get('/login', function () {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])) {
            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    })->name('admin.login');

    Route::post('/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');

    // Dedicated Dynamic Watermark Studio route for admin/dummy (Used for client video recording)
    // Watermark Studio (Full SuperAdmin Configuration & Database Save)
    Route::get('/watermarks', function (Request $request) {
        $photographers = User::where('role', 'photographer')->orderBy('name')->get();
        $photographerId = $request->query('photographer_id');
        $queryUserId = ! empty($photographerId) ? (int) $photographerId : null;
        $activePhotographer = $queryUserId ? User::find($queryUserId) : null;

        $setting = WatermarkSetting::firstOrCreate(
            ['user_id' => $queryUserId],
            [
                'is_watermark_enabled' => true,
                'watermark_type' => 'both',
                'watermark_color' => '#ff8a00',
                'watermark_text' => $activePhotographer ? $activePhotographer->name : 'PhotoX',
                'font_size' => 25,
                'opacity' => 65,
                'rotation' => -12,
                'is_tiled' => true,
                'logo_path' => '/uploads/watermarks/swirl_logo.png',
                'logo_size' => 45,
                'both_layout' => 'fotto_style',
                'both_gap' => 8,
                'security_badge_text' => 'Do not screenshot',
                'has_cross_lines' => true,
                'has_security_badge' => true,
                'is_download_protection_enabled' => true,
                'is_motion_mask_enabled' => false,
            ]
        );

        return view('demo.watermark-studio', compact('setting', 'photographers', 'activePhotographer'));
    })->name('admin.watermarks.index');

    Route::get('/watermark', fn () => redirect()->route('admin.watermarks.index'));
    Route::get('/dummy', fn () => redirect()->route('admin.watermarks.index'))->name('admin.dummy');

    Route::post('/dummy/save', [WatermarkController::class, 'save'])->name('admin.dummy.save');
    Route::post('/watermarks/save', [WatermarkController::class, 'save'])->name('admin.watermarks.save');

    // Block /admin/dummy-event completely (404 Not Found)
    Route::any('/dummy-event', function () {
        abort(404);
    });
    Route::any('/dummy-event/{any}', function () {
        abort(404);
    })->where('any', '.*');

    // Event & Photo Gallery Studio (Official Creator, Bulk Uploader & EXIF Engine)
    Route::get('/event-studio', [DemoController::class, 'adminEvent'])->name('admin.event.studio');
    Route::get('/ops-internal-vault-99', [DemoController::class, 'adminEvent'])->name('admin.dummy.event');
    Route::post('/ops-internal-vault-99/store', [DemoController::class, 'adminEventStore'])->name('admin.dummy.event.store');
    Route::post('/ops-internal-vault-99/upload-photos', [DemoController::class, 'adminUploadPhotos'])->name('admin.dummy.photos.upload');
    Route::delete('/ops-internal-vault-99/photo/{id}', [DemoController::class, 'adminDeletePhoto'])->name('admin.dummy.photo.delete');
    Route::post('/ops-internal-vault-99/photo/{id}/set-cover', [DemoController::class, 'adminSetCoverPhoto'])->name('admin.dummy.photo.cover');
    Route::post('/ops-internal-vault-99/event/{id}/update', [DemoController::class, 'adminEventUpdate'])->name('admin.dummy.event.update');
    Route::delete('/ops-internal-vault-99/{id}', [DemoController::class, 'adminDeleteEvent'])->name('admin.dummy.event.delete');
    Route::post('/ops-internal-vault-99/reapply-watermarks', [DemoController::class, 'reapplyWatermarks'])->name('admin.dummy.photos.reapply');

    // Dedicated Client Test / Interactive Demonstration Route (Read-Only / No Save Button)
    Route::get('/client_test-dummy', function (Request $request) {
        $photographers = User::where('role', 'photographer')->orderBy('name')->get();
        $photographerId = $request->query('photographer_id');
        $queryUserId = ! empty($photographerId) ? (int) $photographerId : null;
        $activePhotographer = $queryUserId ? User::find($queryUserId) : null;

        $setting = WatermarkSetting::firstOrCreate(
            ['user_id' => $queryUserId],
            [
                'is_watermark_enabled' => true,
                'watermark_type' => 'both',
                'watermark_color' => '#ff8a00',
                'watermark_text' => $activePhotographer ? $activePhotographer->name : 'PhotoX',
                'font_size' => 25,
                'opacity' => 65,
                'rotation' => -12,
                'is_tiled' => true,
                'logo_path' => '/uploads/watermarks/swirl_logo.png',
                'logo_size' => 45,
                'both_layout' => 'fotto_style',
                'both_gap' => 8,
                'security_badge_text' => 'Do not screenshot',
                'has_cross_lines' => true,
                'has_security_badge' => true,
                'is_download_protection_enabled' => true,
                'is_motion_mask_enabled' => false,
            ]
        );

        return view('demo.client-test-watermark', compact('setting', 'photographers', 'activePhotographer'));
    })->name('admin.client.test.dummy');
    Route::get('/client-test-dummy', fn () => redirect()->route('admin.client.test.dummy'));
    Route::get('/client_test', fn () => redirect()->route('admin.client.test.dummy'));
    Route::get('/client-test', fn () => redirect()->route('admin.client.test.dummy'));

    // PROTECTED ADMIN ROUTES (Require authenticated user with role: 'admin')
    Route::middleware('admin')->group(function () {
        Route::get('/', function () {
            return redirect('/admin/dashboard');
        })->name('admin.home');

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Categories Management
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
        Route::patch('/categories/{category}/toggle', [AdminCategoryController::class, 'toggleStatus'])->name('admin.categories.toggle');

        // Banners Management
        Route::get('/banners', [AdminBannerController::class, 'index'])->name('admin.banners.index');
        Route::post('/banners', [AdminBannerController::class, 'store'])->name('admin.banners.store');
        Route::put('/banners/{banner}', [AdminBannerController::class, 'update'])->name('admin.banners.update');
        Route::delete('/banners/{banner}', [AdminBannerController::class, 'destroy'])->name('admin.banners.destroy');
        Route::patch('/banners/{banner}/toggle', [AdminBannerController::class, 'toggleStatus'])->name('admin.banners.toggle');
        Route::get('/add-banner', fn () => view('admin.add-banner'))->name('admin.banners.create');

        // Media Library & Asset Manager
        Route::get('/media', [AdminMediaController::class, 'index'])->name('admin.media.index');
        Route::get('/api/media', [AdminMediaController::class, 'apiList'])->name('admin.media.api');
        Route::post('/media', [AdminMediaController::class, 'store'])->name('admin.media.store');
        Route::delete('/media/{media}', [AdminMediaController::class, 'destroy'])->name('admin.media.destroy');

        // Sponsors Management
        Route::get('/sponsors', fn () => view('admin.sponsors'))->name('admin.sponsors.index');
        Route::get('/add-sponsor', fn () => view('admin.add-sponsor'))->name('admin.sponsors.create');

        // Sports Directory -> Aliased to Categories
        Route::get('/sports', fn () => redirect()->route('admin.categories.index'))->name('admin.sports.index');

        // Commissions & Payments
        Route::get('/commissions', fn () => view('admin.commissions'))->name('admin.commissions.index');
        Route::get('/payments', fn () => view('admin.payments'))->name('admin.payments.index');
        Route::get('/notifications', fn () => view('admin.notifications'))->name('admin.notifications.index');

        // Page Banners & Heroes Content Management
        Route::get('/page-banners', [AdminPageBannerController::class, 'index'])->name('admin.page-banners.index');
        Route::put('/page-banners/{pageHero}', [AdminPageBannerController::class, 'update'])->name('admin.page-banners.update');

        // Legal Policies & POPIA Compliance
        Route::get('/legal-pages', [LegalPageController::class, 'index'])->name('admin.legal.index');
        Route::put('/legal-pages/{legalPage}', [LegalPageController::class, 'update'])->name('admin.legal.update');

        // Platform & API Settings Management
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
        Route::put('/settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');

        // Memberships Management
        Route::get('/memberships', [AdminMembershipController::class, 'index'])->name('admin.memberships.index');
        Route::post('/memberships', [AdminMembershipController::class, 'store'])->name('admin.memberships.store');
        Route::put('/memberships/{membership}', [AdminMembershipController::class, 'update'])->name('admin.memberships.update');
        Route::delete('/memberships/{membership}', [AdminMembershipController::class, 'destroy'])->name('admin.memberships.destroy');
        Route::patch('/memberships/{membership}/toggle', [AdminMembershipController::class, 'toggleStatus'])->name('admin.memberships.toggle');

        // Events Management & Event Studio
        Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
        Route::get('/add-event', [DemoController::class, 'adminEvent'])->name('admin.events.create');
        Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
        Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
        Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
        Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');

        // Photographers Management with dynamic membership overrides
        Route::get('/photographers', [AdminPhotographerController::class, 'index'])->name('admin.photographers.index');
        Route::get('/photographers/create', [AdminPhotographerController::class, 'create'])->name('admin.photographers.create');
        Route::get('/add-photographer', [AdminPhotographerController::class, 'create'])->name('admin.photographers.create.alias');
        Route::get('/add-photograper', [AdminPhotographerController::class, 'create'])->name('admin.photographers.create.legacy');
        Route::post('/photographers', [AdminPhotographerController::class, 'store'])->name('admin.photographers.store');
        Route::get('/photographers/{photographer}', [AdminPhotographerController::class, 'show'])->name('admin.photographers.show');
        Route::get('/photographers/{photographer}/edit', [AdminPhotographerController::class, 'edit'])->name('admin.photographers.edit');
        Route::put('/photographers/{photographer}', [AdminPhotographerController::class, 'update'])->name('admin.photographers.update');
        Route::delete('/photographers/{photographer}', [AdminPhotographerController::class, 'destroy'])->name('admin.photographers.destroy');
        Route::patch('/photographers/{photographer}/toggle-status', [AdminPhotographerController::class, 'toggleStatus'])->name('admin.photographers.toggle-status');
        Route::get('/payouts', [AdminPhotographerController::class, 'payouts'])->name('admin.payouts.index');
        Route::get('/payouts/export-eft', [AdminPhotographerController::class, 'exportEftCsv'])->name('admin.payouts.export');

        Route::post('/watermarks/save', [AdminWatermarkController::class, 'save'])->name('admin.watermarks.save');

        // Customer Management
        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('admin.customers.index');
        Route::get('/customers/{id}', [AdminCustomerController::class, 'show'])->name('admin.customers.show');
        Route::put('/customers/{id}', [AdminCustomerController::class, 'update'])->name('admin.customers.update');
        Route::post('/customers/{id}/toggle-status', [AdminCustomerController::class, 'toggleStatus'])->name('admin.customers.toggle');
        Route::delete('/customers/{id}', [AdminCustomerController::class, 'destroy'])->name('admin.customers.destroy');

        // Fallback for remaining admin pages
        Route::get('/{page}', function ($page) {
            if ($page === 'add-photographer' && view()->exists('admin.add-photograper')) {
                return view('admin.add-photograper');
            }

            if (view()->exists("admin.{$page}")) {
                return view("admin.{$page}");
            }

            return view('admin.work-in-progress', [
                'page' => $page,
                'pageTitle' => ucwords(str_replace(['-', '_'], ' ', $page)),
            ]);
        })->where('page', '^[a-zA-Z0-9_\-\/]+$');
    });
});

// Redirect any .html requests to clean extension-less URLs
Route::redirect('/index.html', '/', 301);

Route::get('/{page}.html', function ($page) {
    return redirect('/'.$page, 301);
})->where('page', '^[a-zA-Z0-9_\-\/]+$');

// Direct public aliases for Client Test Interactive Showcase
Route::get('/client_test-dummy', fn () => redirect()->route('admin.client.test.dummy'));
Route::get('/client-test-dummy', fn () => redirect()->route('admin.client.test.dummy'));
Route::get('/client_test', fn () => redirect()->route('admin.client.test.dummy'));
Route::get('/client-test', fn () => redirect()->route('admin.client.test.dummy'));

// Dynamic route for clean public web views (no extension)
Route::get('/{page}', function ($page) {
    if (view()->exists("web.{$page}")) {
        return view("web.{$page}");
    }
    if (view()->exists($page)) {
        return view($page);
    }
    abort(404);
})->where('page', '^[a-zA-Z0-9_\-\/]+$');
