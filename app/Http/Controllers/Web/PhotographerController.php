<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\User;
use App\Models\WatermarkSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhotographerController extends Controller
{
    /**
     * Display a photographer's profile, real albums, and secure watermarked gallery.
     */
    public function show(Request $request, ?string $id = null): View
    {
        // 1. Fetch photographer: by id/slug or default to Aiden Daniels / active photographer
        $photographer = null;
        if ($id) {
            $photographer = User::where('role', 'photographer')->where('id', $id)->first();
        }

        if (! $photographer) {
            $photographer = User::where('role', 'photographer')->where('email', 'aiden@photox.com')->first()
                ?: User::where('role', 'photographer')->first();
        }

        if (! $photographer) {
            $photographer = new User([
                'name' => 'Aiden Daniels',
                'email' => 'aiden@photox.com',
                'role' => 'photographer',
                'status' => 'active',
                'tier' => 'pro',
                'phone' => '+27 21 555 0192',
                'avatar' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=600&q=90',
                'bio' => 'Documentary sports photography for the split second, the quiet build-up and everything that happens after the finish line. Based in Cape Town, covering marathons, rugby, track & cycling.',
            ]);
        }

        // 2. Real Albums from database (Events with photos)
        $albums = Event::where('status', 'published')
            ->withCount('photos')
            ->with('photos')
            ->orderByRaw('CASE WHEN photos_count > 0 THEN 0 ELSE 1 END ASC')
            ->latest('event_date')
            ->take(12)
            ->get();

        if ($albums->isEmpty()) {
            $albums = Event::with('photos')->latest()->take(12)->get();
        }

        // 3. Real Gallery Photos (Secure watermarked photos)
        $photosQuery = EventPhoto::with('event.category')->where('is_demo', true)->latest();

        if ($request->filled('event_id')) {
            $photosQuery->where('event_id', (int) $request->input('event_id'));
        }

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $cat = $request->input('category');
            $photosQuery->whereHas('event', function ($q) use ($cat) {
                $q->where('category_name', $cat);
            });
        }

        $photos = $photosQuery->get();
        if ($photos->isEmpty()) {
            $photos = EventPhoto::with('event.category')->latest()->take(24)->get();
        }

        // 4. Categories for filtering
        $categories = Category::where('is_active', true)->orderBy('name', 'asc')->get();

        // 5. Watermark settings & Sponsor Banner
        $watermarkSetting = WatermarkSetting::firstOrCreate(['user_id' => null]);
        $imagePreviewBanner = Banner::where('is_active', true)->where('placement', 'image_preview')->first()
            ?: Banner::where('is_active', true)->first();

        return view('web.photographer-details', compact(
            'photographer',
            'albums',
            'photos',
            'categories',
            'watermarkSetting',
            'imagePreviewBanner'
        ));
    }
}
