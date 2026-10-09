<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\PageHero;
use App\Models\User;
use App\Models\WatermarkSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhotographerController extends Controller
{
    /**
     * Display the dynamic roster of photographers.
     */
    public function index(): View
    {
        $photographers = User::where('role', 'photographer')
            ->where('status', 'active')
            ->with(['membership', 'events'])
            ->withCount('events')
            ->orderByRaw("CASE WHEN tier = 'photoguild' THEN 0 WHEN tier = 'pro' THEN 1 WHEN tier = 'standard' THEN 2 ELSE 3 END")
            ->orderBy('id', 'asc')
            ->get();

        $pageHeroes = PageHero::all()->keyBy('page_key');

        return view('web.photographers', compact('photographers', 'pageHeroes'));
    }

    /**
     * Display a photographer's profile, real albums, and secure watermarked gallery.
     */
    public function show(Request $request, ?string $id = null): View
    {
        // 1. Fetch photographer: by id, slug, username or default to Aiden Daniels
        $photographer = null;
        if ($id) {
            $cleanLookup = strtolower(str_replace(['-', '_', '@'], '', $id));
            $photographer = User::where('role', 'photographer')
                ->where(function ($q) use ($id, $cleanLookup) {
                    $q->where('id', $id)
                        ->orWhere('email', $id)
                        ->orWhereRaw("REPLACE(LOWER(name), ' ', '') = ?", [$cleanLookup])
                        ->orWhere('name', 'like', "%{$id}%");
                })->first();
        }

        if (! $photographer) {
            $photographer = User::where('role', 'photographer')->where('email', 'aiden@photox.com')->first()
                ?: User::where('role', 'photographer')->first();
        }

        if (! $photographer) {
            abort(404, 'Photographer not found');
        }

        // 2. Real Albums from database (Events belonging to this photographer)
        $albums = Event::where('photographer_id', $photographer->id)
            ->where('status', 'published')
            ->withCount('photos')
            ->with('photos')
            ->latest('event_date')
            ->get();

        if ($albums->isEmpty()) {
            $albums = Event::where('status', 'published')
                ->withCount('photos')
                ->latest('event_date')
                ->take(4)
                ->get();
        }

        // 3. Real Gallery Photos for this photographer
        $photosQuery = EventPhoto::where(function ($q) use ($photographer) {
            $q->where('photographer_id', $photographer->id)
                ->orWhereIn('event_id', $photographer->events()->pluck('id'))
                ->orWhere('photographer_name', $photographer->name);
        })->with('event.category')->latest();

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
            $photos = EventPhoto::with('event.category')->latest()->take(12)->get();
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
