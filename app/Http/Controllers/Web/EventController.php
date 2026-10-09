<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\WatermarkSetting;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function home(Request $request)
    {
        $banners = Banner::where('is_active', true)
            ->where('placement', 'events_hero')
            ->orderBy('sort_order')
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();

        $popularCategories = Category::where('is_active', true)
            ->orderByRaw('CASE WHEN sort_order > 0 THEN sort_order ELSE 9999 END ASC, name ASC')
            ->take(8)
            ->get();

        $featuredEvents = Event::where('status', 'published')
            ->where('is_demo', false)
            ->where('is_featured', true)
            ->latest('event_date')
            ->take(3)
            ->get();

        $eventsQuery = Event::where('status', 'published')
            ->where('is_demo', false)
            ->latest('event_date');

        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $eventsQuery->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('location', 'like', "%{$keyword}%")
                    ->orWhere('category_name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'All categories') {
            $catSlugOrName = $request->input('category');
            $eventsQuery->where(function ($q) use ($catSlugOrName) {
                $q->where('category_name', $catSlugOrName)
                    ->orWhereHas('category', function ($sub) use ($catSlugOrName) {
                        $sub->where('slug', $catSlugOrName)->orWhere('name', $catSlugOrName);
                    });
            });
        }

        if ($request->filled('date')) {
            $dateRange = $request->input('date');
            if ($dateRange === 'upcoming') {
                $eventsQuery->where('event_date', '>=', now()->toDateString());
            } elseif ($dateRange === 'past30') {
                $eventsQuery->whereBetween('event_date', [now()->subDays(30)->toDateString(), now()->toDateString()]);
            } elseif ($dateRange === 'past90') {
                $eventsQuery->whereBetween('event_date', [now()->subDays(90)->toDateString(), now()->toDateString()]);
            }
        }

        $events = $eventsQuery->get();

        return view('web.index', compact('banners', 'categories', 'popularCategories', 'featuredEvents', 'events'));
    }

    public function index(Request $request)
    {
        // 1. Dynamic Hero Banners (Events Hero Placement)
        $banners = Banner::where('is_active', true)
            ->where('placement', 'events_hero')
            ->orderBy('sort_order')
            ->get();

        // 2. Dynamic Categories (Sorted alphabetically A-Z)
        $categories = Category::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();

        // 3. Featured Events
        $featuredEvents = Event::where('status', 'published')
            ->where('is_featured', true)
            ->latest('event_date')
            ->take(3)
            ->get();

        // 4. All Events with filtering
        $eventsQuery = Event::where('status', 'published')->latest('event_date');

        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $eventsQuery->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('location', 'like', "%{$keyword}%")
                    ->orWhere('category_name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'All categories') {
            $catSlugOrName = $request->input('category');
            $eventsQuery->where(function ($q) use ($catSlugOrName) {
                $q->where('category_name', $catSlugOrName)
                    ->orWhereHas('category', function ($sub) use ($catSlugOrName) {
                        $sub->where('slug', $catSlugOrName)->orWhere('name', $catSlugOrName);
                    });
            });
        }

        if ($request->filled('date')) {
            $dateRange = $request->input('date');
            if ($dateRange === 'upcoming') {
                $eventsQuery->where('event_date', '>=', now()->toDateString());
            } elseif ($dateRange === 'past30') {
                $eventsQuery->whereBetween('event_date', [now()->subDays(30)->toDateString(), now()->toDateString()]);
            } elseif ($dateRange === 'past90') {
                $eventsQuery->whereBetween('event_date', [now()->subDays(90)->toDateString(), now()->toDateString()]);
            }
        }

        $events = $eventsQuery->get();

        return view('web.events', compact('banners', 'categories', 'featuredEvents', 'events'));
    }

    public function show($slug = null)
    {
        $event = null;
        if ($slug) {
            $event = Event::where('slug', $slug)->with('photos')->first();
        }

        if (! $event) {
            $event = Event::where('total_photos', '>', 0)->with('photos')->first()
                ?: Event::with('photos')->first();
        }

        if (! $event) {
            $event = new Event([
                'title' => 'Cape Town Marathon 2026',
                'location' => 'Cape Town, South Africa',
                'category_name' => 'Running',
                'event_date' => now()->toDateString(),
                'starting_price' => 'From R90',
                'total_photos' => 24812,
                'photographers_count' => 12,
                'description' => "Celebrating the energy, emotion and endurance of one of the city's biggest sporting weekends. Discover the story, venue, gallery and highlights from one beautifully organised event.",
            ]);
        }

        $photos = $event->photos ?? collect();
        if ($photos->isEmpty()) {
            $photos = EventPhoto::where('event_id', 1)->orderBy('id', 'asc')->get();
            if ($photos->isEmpty()) {
                $photos = EventPhoto::orderBy('id', 'asc')->get();
            }
        }

        $relatedEvents = Event::where('id', '!=', $event->id ?? 0)
            ->where('status', 'published')
            ->latest('event_date')
            ->take(6)
            ->get();

        if ($relatedEvents->isEmpty()) {
            $relatedEvents = Event::where('id', '!=', $event->id ?? 0)->take(4)->get();
        }

        $sponsorBanner = Banner::where('is_active', true)->where('placement', 'image_preview')->first();
        if (! $sponsorBanner && ! empty($event->category_id)) {
            $sponsorBanner = Banner::where('is_active', true)->where('category_id', $event->category_id)->first();
        }
        if (! $sponsorBanner) {
            $sponsorBanner = Banner::where('is_active', true)->first();
        }

        $watermarkSetting = WatermarkSetting::firstOrCreate(['user_id' => null]);

        return view('web.event-details', compact('event', 'photos', 'relatedEvents', 'sponsorBanner', 'watermarkSetting'));
    }
}
