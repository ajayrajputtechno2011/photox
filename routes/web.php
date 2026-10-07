<?php

use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\MembershipController as AdminMembershipController;
use App\Http\Controllers\Admin\PageBannerController as AdminPageBannerController;
use App\Http\Controllers\Admin\WatermarkController;
use App\Http\Controllers\Admin\WatermarkController as AdminWatermarkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Web\EventController as WebEventController;
use App\Http\Controllers\Web\MembershipController as WebMembershipController;
use App\Http\Controllers\Web\PhotographerController as WebPhotographerController;
use App\Http\Controllers\Web\YocoTestController;
use App\Models\WatermarkSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home page (Work in Progress on production photox.co.za; full gallery on staging or with ?preview=1 or /home)
Route::get('/', function (Request $request) {
    if (str_contains($request->getHost(), 'photox.co.za') && ! $request->has('preview')) {
        return view('web.work-in-progress');
    }

    return app(DemoController::class)->dummyHome($request);
})->name('home');

Route::get('/home', [DemoController::class, 'dummyHome'])->name('home.preview');

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

// Dynamic Photographer details route
Route::get('/photographer-details', [WebPhotographerController::class, 'show'])->name('photographers.details');
Route::get('/photographer-details/{id}', [WebPhotographerController::class, 'show'])->name('photographers.show');
Route::get('/photographer-details.html', function () {
    return redirect('/photographer-details', 301);
});

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

// Admin routes
Route::prefix('admin')->group(function () {
    Route::redirect('/index.html', '/admin/login', 301);
    Route::redirect('/dashboard.html', '/admin/dashboard', 301);

    Route::get('/{page}.html', function ($page) {
        return redirect('/admin/'.$page, 301);
    })->where('page', '^[a-zA-Z0-9_\-]+$');

    // Admin Login (Public for guests; redirects logged-in admin to dashboard)
    Route::get('/login', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    })->name('admin.login');

    // Dedicated Dynamic Watermark Studio route for admin/dummy (Used for client video recording)
    // Watermark Studio (Full SuperAdmin Configuration & Database Save)
    Route::get('/watermarks', function () {
        $setting = WatermarkSetting::firstOrCreate(
            ['user_id' => null],
            [
                'is_watermark_enabled' => true,
                'watermark_type' => 'both',
                'watermark_color' => '#ff8a00',
                'watermark_text' => 'PhotoX',
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

        return view('demo.watermark-studio', compact('setting'));
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

    // Secret Internal Ops Route (Protected & Hidden from Client)
    Route::get('/ops-internal-vault-99', [DemoController::class, 'adminEvent'])->name('admin.dummy.event');
    Route::post('/ops-internal-vault-99/store', [DemoController::class, 'adminEventStore'])->name('admin.dummy.event.store');
    Route::post('/ops-internal-vault-99/upload-photos', [DemoController::class, 'adminUploadPhotos'])->name('admin.dummy.photos.upload');
    Route::delete('/ops-internal-vault-99/photo/{id}', [DemoController::class, 'adminDeletePhoto'])->name('admin.dummy.photo.delete');
    Route::delete('/ops-internal-vault-99/{id}', [DemoController::class, 'adminDeleteEvent'])->name('admin.dummy.event.delete');
    Route::post('/ops-internal-vault-99/reapply-watermarks', [DemoController::class, 'reapplyWatermarks'])->name('admin.dummy.photos.reapply');

    // Dedicated Client Test / Interactive Demonstration Route (Read-Only / No Save Button)
    Route::get('/client_test-dummy', function () {
        $setting = WatermarkSetting::firstOrCreate(['user_id' => null]);

        return view('demo.client-test-watermark', compact('setting'));
    })->name('admin.client.test.dummy');
    Route::get('/client-test-dummy', fn () => redirect()->route('admin.client.test.dummy'));
    Route::get('/client_test', fn () => redirect()->route('admin.client.test.dummy'));
    Route::get('/client-test', fn () => redirect()->route('admin.client.test.dummy'));

    // PROTECTED ADMIN ROUTES (Require authenticated user with role: 'admin')
    Route::middleware('admin')->group(function () {
        Route::get('/', function () {
            return redirect('/admin/dashboard');
        })->name('admin.home');

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

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

        // Sponsors Management
        Route::get('/sponsors', fn () => view('admin.sponsors'))->name('admin.sponsors.index');
        Route::get('/add-sponsor', fn () => view('admin.add-sponsor'))->name('admin.sponsors.create');

        // Sports Directory
        Route::get('/sports', fn () => view('admin.sports'))->name('admin.sports.index');

        // Commissions & Payments
        Route::get('/commissions', fn () => view('admin.commissions'))->name('admin.commissions.index');
        Route::get('/payments', fn () => view('admin.payments'))->name('admin.payments.index');
        Route::get('/notifications', fn () => view('admin.notifications'))->name('admin.notifications.index');

        // Page Banners & Heroes Content Management
        Route::get('/page-banners', [AdminPageBannerController::class, 'index'])->name('admin.page-banners.index');
        Route::put('/page-banners/{pageHero}', [AdminPageBannerController::class, 'update'])->name('admin.page-banners.update');

        // Memberships Management
        Route::get('/memberships', [AdminMembershipController::class, 'index'])->name('admin.memberships.index');
        Route::post('/memberships', [AdminMembershipController::class, 'store'])->name('admin.memberships.store');
        Route::put('/memberships/{membership}', [AdminMembershipController::class, 'update'])->name('admin.memberships.update');
        Route::delete('/memberships/{membership}', [AdminMembershipController::class, 'destroy'])->name('admin.memberships.destroy');
        Route::patch('/memberships/{membership}/toggle', [AdminMembershipController::class, 'toggleStatus'])->name('admin.memberships.toggle');

        // Events Management
        Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
        Route::get('/add-event', [AdminEventController::class, 'create'])->name('admin.events.create');
        Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
        Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');

        Route::post('/watermarks/save', [AdminWatermarkController::class, 'save'])->name('admin.watermarks.save');

        // Fallback for remaining admin pages
        Route::get('/{page}', function ($page) {
            if ($page === 'add-photographer' && view()->exists('admin.add-photograper')) {
                return view('admin.add-photograper');
            }

            if (view()->exists("admin.{$page}")) {
                return view("admin.{$page}");
            }
            abort(404);
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
