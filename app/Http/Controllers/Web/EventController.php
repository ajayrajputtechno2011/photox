<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\User;
use App\Models\WatermarkSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    public function home(Request $request)
    {
        $banners = Banner::where('is_active', true)
            ->whereIn('placement', ['events_hero', 'explore_hero', 'home_top'])
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
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('photographer_name', 'like', "%{$keyword}%")
                    ->orWhereHas('photographer', function ($sub) use ($keyword) {
                        $sub->where('name', 'like', "%{$keyword}%");
                    });
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
            ->whereIn('placement', ['events_hero', 'explore_hero', 'home_top'])
            ->orderBy('sort_order')
            ->get();

        // 2. Dynamic Categories with Event Counts (Sorted alphabetically A-Z)
        $categories = Category::where('is_active', true)
            ->withCount(['events' => function ($q) {
                $q->where('status', 'published');
            }])
            ->orderBy('name', 'asc')
            ->get();

        $popularCategories = Category::where('is_active', true)
            ->withCount(['events' => function ($q) {
                $q->where('status', 'published');
            }])
            ->orderByRaw('CASE WHEN sort_order > 0 THEN sort_order ELSE 9999 END ASC, name ASC')
            ->take(8)
            ->get();

        // 3. Featured Events
        $featuredEvents = Event::where('status', 'published')
            ->where('is_featured', true)
            ->with('photographer')
            ->latest('event_date')
            ->take(3)
            ->get();

        if ($featuredEvents->isEmpty()) {
            $featuredEvents = Event::where('status', 'published')
                ->with('photographer')
                ->latest('event_date')
                ->take(3)
                ->get();
        }

        // 4. All Events with filtering
        $eventsQuery = Event::where('status', 'published')
            ->with('photographer')
            ->latest('event_date');

        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $eventsQuery->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('location', 'like', "%{$keyword}%")
                    ->orWhere('category_name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('photographer_name', 'like', "%{$keyword}%")
                    ->orWhereHas('photographer', function ($sub) use ($keyword) {
                        $sub->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        if ($request->filled('category') && ! in_array($request->input('category'), ['All categories', 'all', ''])) {
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
        $totalEventsCount = Event::where('status', 'published')->count();

        // 5. In-page sponsor banner placement (collection for dynamic auto-rotation)
        $sponsorBanners = Banner::where('is_active', true)
            ->whereIn('placement', ['home_before_featured', 'event_detail', 'marketplace', 'explore_hero', 'image_preview'])
            ->orderBy('sort_order')
            ->get();

        $sponsorBanner = $sponsorBanners->first();

        return view('web.events', compact('banners', 'categories', 'popularCategories', 'featuredEvents', 'events', 'totalEventsCount', 'sponsorBanner', 'sponsorBanners'));
    }

    public function show($slug = null)
    {
        $event = null;
        if ($slug) {
            $event = Event::where('slug', $slug)->with('photos')->first();
            if (! $event) {
                abort(404, 'Event not found');
            }
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
        // Only load sample fallback photos if viewing the generic demo page without any slug
        if (! $slug && $photos->isEmpty()) {
            $photos = EventPhoto::where('event_id', 1)->orderBy('id', 'asc')->get();
            if ($photos->isEmpty()) {
                $photos = EventPhoto::orderBy('id', 'asc')->take(12)->get();
            }
        }

        $relatedEvents = Event::where('id', '!=', $event->id ?? 0)
            ->where('status', 'published')
            ->when(! empty($event->category_name), function ($q) use ($event) {
                $q->orderByRaw('CASE WHEN category_name = ? THEN 0 ELSE 1 END', [$event->category_name]);
            })
            ->latest('event_date')
            ->take(4)
            ->get();

        if ($relatedEvents->isEmpty()) {
            $relatedEvents = Event::where('id', '!=', $event->id ?? 0)->where('status', 'published')->take(4)->get();
        }

        // Prioritize category-targeted banner if event belongs to a category (e.g. Rugby)
        $sponsorBanner = null;
        if (! empty($event->category_id)) {
            $sponsorBanner = Banner::where('is_active', true)->where('category_id', $event->category_id)->first();
        }
        if (! $sponsorBanner && ! empty($event->category_name)) {
            $sponsorBanner = Banner::where('is_active', true)->where('category_name', $event->category_name)->first();
        }
        if (! $sponsorBanner) {
            $sponsorBanner = Banner::where('is_active', true)->where('placement', 'event_detail')->first();
        }
        if (! $sponsorBanner) {
            $sponsorBanner = Banner::where('is_active', true)->where('placement', 'home_before_featured')->first();
        }
        if (! $sponsorBanner) {
            $sponsorBanner = Banner::where('is_active', true)->where('placement', 'image_preview')->first();
        }
        if (! $sponsorBanner) {
            $sponsorBanner = Banner::where('is_active', true)->first();
        }

        $watermarkSetting = null;
        if (! empty($event->photographer_id)) {
            $watermarkSetting = WatermarkSetting::where('user_id', $event->photographer_id)->first();
        }
        if (! $watermarkSetting) {
            $watermarkSetting = WatermarkSetting::firstOrCreate(['user_id' => null]);
        }

        $isLocked = false;
        if (! empty($event->is_password_protected) && ! empty($event->access_password)) {
            $unlocked = session()->get("event_unlocked_{$event->id}", false);
            if (! $unlocked && auth()->check()) {
                $user = auth()->user();
                if ($user->photographer_id == $event->photographer_id || $user->id == $event->photographer_id || ($user->role ?? null) === 'admin') {
                    $unlocked = true;
                }
            }
            if (! $unlocked) {
                $isLocked = true;
            }
        }

        $savedPhotoIds = auth()->check() ? auth()->user()->savedPhotos()->pluck('event_photo_id')->toArray() : [];
        $isEventSaved = auth()->check() && ! empty($event->id) ? auth()->user()->savedEvents()->where('event_id', $event->id)->exists() : false;

        return view('web.event-details', compact('event', 'photos', 'relatedEvents', 'sponsorBanner', 'watermarkSetting', 'savedPhotoIds', 'isEventSaved', 'isLocked'));
    }

    /**
     * Unlock a password-protected event gallery.
     */
    public function unlockPassword(Request $request, int $id): RedirectResponse
    {
        $event = Event::findOrFail($id);
        $request->validate([
            'password' => 'required|string',
        ]);

        if (hash_equals((string) $event->access_password, (string) $request->input('password'))) {
            session()->put("event_unlocked_{$event->id}", true);

            return back()->with('success', 'Gallery unlocked successfully!');
        }

        return back()->withErrors(['password' => 'Incorrect event access password. Please try again.']);
    }

    /**
     * Subscribe user email to receive an alert when event photos go live.
     */
    public function subscribeNotification(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $event = Event::findOrFail($id);
        $email = strtolower(trim($request->input('email')));

        DB::table('event_notifications')->insertOrIgnore([
            'event_id' => $event->id,
            'email' => $email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $photoCount = EventPhoto::where('event_id', $event->id)->count();
        $eventUrl = url('/event-details/'.($event->slug ?: $event->id));
        $eventTitle = $event->title;
        $eventDate = $event->event_date ? date('d M Y', strtotime($event->event_date)) : 'Upcoming';
        $eventLocation = $event->location ?: 'South Africa';

        // If photos are already live for this event, send live gallery link immediately!
        if ($photoCount > 0) {
            try {
                $subject = "Photos are now LIVE: {$eventTitle} · PhotoX";
                $html = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="margin: 0; padding: 0; background-color: #07152b; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #e2e8f0;">
    <div style="max-width: 600px; margin: 30px auto; background-color: #0b1a29; border: 1px solid #1e3a5f; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        <div style="background: linear-gradient(135deg, #071e3d 0%, #0d2847 100%); padding: 32px 24px; text-align: center; border-bottom: 2px solid #ff8a00;">
            <a href="https://photox.co.za" style="text-decoration: none; display: inline-block;">
                <img src="https://photox.co.za/logo.png" alt="PhotoX" style="height: 48px; width: auto; max-width: 220px; display: inline-block; border: 0;" />
            </a>
            <p style="color: #94a3b8; margin: 8px 0 0; font-size: 13px; letter-spacing: 0.5px;">Official Sports Photography &amp; Protected Gallery</p>
        </div>
        <div style="padding: 32px 28px;">
            <div style="display: inline-block; background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.4); border-radius: 20px; padding: 4px 12px; margin-bottom: 16px;">
                <span style="color: #4ade80; font-size: 11px; font-weight: 700; text-transform: uppercase;">✓ Gallery Live Alert</span>
            </div>
            <h2 style="color: #ffffff; font-size: 20px; margin: 0 0 16px 0;">Photos for {$eventTitle} are available now!</h2>
            <p style="color: #cbd5e1; font-size: 15px; line-height: 1.6; margin: 0 0 20px 0;">
                The official high-resolution photo collection for <strong style="color: #ff8a00;">{$eventTitle}</strong> is published and ready to explore on PhotoX.
            </p>
            <div style="background-color: #06111c; border: 1px solid #162a3d; border-radius: 8px; padding: 14px 18px; margin-bottom: 24px; font-size: 13px;">
                <div style="color: #94a3b8; margin-bottom: 6px;"><strong style="color: #e2e8f0;">Event:</strong> {$eventTitle}</div>
                <div style="color: #94a3b8; margin-bottom: 6px;"><strong style="color: #e2e8f0;">Date:</strong> {$eventDate}</div>
                <div style="color: #94a3b8;"><strong style="color: #e2e8f0;">Location:</strong> {$eventLocation}</div>
            </div>
            <div style="text-align: center; margin: 28px 0;">
                <a href="{$eventUrl}" style="background-color: #ff8a00; color: #000000; font-weight: 700; text-decoration: none; padding: 14px 34px; border-radius: 8px; font-size: 15px; display: inline-block;">
                    View &amp; Find Your Photos &rarr;
                </a>
            </div>
            <p style="color: #94a3b8; font-size: 12px; line-height: 1.5; margin: 0;">
                Sent to {$email} · You can search photos by selfie, bib number, or browse folders.
            </p>
        </div>
        <div style="background-color: #06111c; padding: 18px 24px; text-align: center; border-top: 1px solid #192c3f;">
            <p style="color: #64748b; font-size: 12px; margin: 0;">&copy; 2026 PhotoX (Pty) Ltd · Cape Town, South Africa · All Rights Reserved</p>
        </div>
    </div>
</body>
</html>
HTML;
                Mail::html($html, function ($message) use ($email, $subject) {
                    $message->to($email)->subject($subject);
                });

                DB::table('event_notifications')
                    ->where('event_id', $event->id)
                    ->where('email', $email)
                    ->update(['notified_at' => now(), 'updated_at' => now()]);
            } catch (\Throwable $e) {
                Log::error("Failed to send live alert to {$email}: ".$e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => "Photos are live now! We have dispatched a direct gallery link to {$email}.",
            ]);
        }

        // Photos are still being uploaded/processed - send immediate confirmation email!
        try {
            $subject = "Photo Alert Request Confirmed: {$eventTitle} · PhotoX";
            $html = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="margin: 0; padding: 0; background-color: #07152b; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #e2e8f0;">
    <div style="max-width: 600px; margin: 30px auto; background-color: #0b1a29; border: 1px solid #1e3a5f; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        <div style="background: linear-gradient(135deg, #071e3d 0%, #0d2847 100%); padding: 32px 24px; text-align: center; border-bottom: 2px solid #ff8a00;">
            <a href="https://photox.co.za" style="text-decoration: none; display: inline-block;">
                <img src="https://photox.co.za/logo.png" alt="PhotoX" style="height: 48px; width: auto; max-width: 220px; display: inline-block; border: 0;" />
            </a>
            <p style="color: #94a3b8; margin: 8px 0 0; font-size: 13px; letter-spacing: 0.5px;">Official Sports Photography &amp; Protected Gallery</p>
        </div>
        <div style="padding: 32px 28px;">
            <div style="display: inline-block; background: rgba(255, 138, 0, 0.15); border: 1px solid rgba(255, 138, 0, 0.4); border-radius: 20px; padding: 4px 12px; margin-bottom: 16px;">
                <span style="color: #ff8a00; font-size: 11px; font-weight: 700; text-transform: uppercase;">✓ Alert Request Confirmed</span>
            </div>
            <h2 style="color: #ffffff; font-size: 20px; margin: 0 0 16px 0;">You're on the priority notification list!</h2>
            <p style="color: #cbd5e1; font-size: 15px; line-height: 1.6; margin: 0 0 20px 0;">
                Hello! We have registered your request for <strong style="color: #ff8a00;">{$eventTitle}</strong>.
            </p>
            <p style="color: #cbd5e1; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                The official event photographers are currently editing and uploading the photos. The moment the gallery is published, we will immediately send you an email with direct access to view, search, and download your high-resolution photos.
            </p>
            <div style="background-color: #06111c; border: 1px solid #162a3d; border-radius: 8px; padding: 14px 18px; margin-bottom: 24px; font-size: 13px;">
                <div style="color: #94a3b8; margin-bottom: 6px;"><strong style="color: #e2e8f0;">Event:</strong> {$eventTitle}</div>
                <div style="color: #94a3b8; margin-bottom: 6px;"><strong style="color: #e2e8f0;">Date:</strong> {$eventDate}</div>
                <div style="color: #94a3b8;"><strong style="color: #e2e8f0;">Location:</strong> {$eventLocation}</div>
            </div>
            <div style="text-align: center; margin: 28px 0;">
                <a href="{$eventUrl}" style="background-color: #ff8a00; color: #000000; font-weight: 700; text-decoration: none; padding: 14px 34px; border-radius: 8px; font-size: 15px; display: inline-block;">
                    View Event Page &rarr;
                </a>
            </div>
            <p style="color: #64748b; font-size: 12px; line-height: 1.5; margin: 0;">
                Confirmation sent to {$email} · You will receive an email alert as soon as photos go live.
            </p>
        </div>
        <div style="background-color: #06111c; padding: 18px 24px; text-align: center; border-top: 1px solid #192c3f;">
            <p style="color: #64748b; font-size: 12px; margin: 0;">&copy; 2026 PhotoX (Pty) Ltd · Cape Town, South Africa · All Rights Reserved</p>
        </div>
    </div>
</body>
</html>
HTML;
            Mail::html($html, function ($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });
        } catch (\Throwable $e) {
            Log::error("Failed to send subscription confirmation to {$email}: ".$e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => "Thank you! We have sent a confirmation email to {$email} and will notify you the moment photos go live.",
        ]);
    }

    /**
     * Dispatch email alerts to subscribers when photos go live.
     */
    public static function dispatchPendingEventNotifications(Event $event): int
    {
        $subscribers = DB::table('event_notifications')
            ->where('event_id', $event->id)
            ->whereNull('notified_at')
            ->get();

        if ($subscribers->isEmpty()) {
            return 0;
        }

        $eventUrl = url('/event-details/'.($event->slug ?: $event->id));
        $eventTitle = $event->title;
        $count = 0;

        foreach ($subscribers as $sub) {
            try {
                $toEmail = $sub->email;
                $subject = "Photos are now LIVE: {$eventTitle} · PhotoX";
                $html = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="margin: 0; padding: 0; background-color: #07152b; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #e2e8f0;">
    <div style="max-width: 600px; margin: 30px auto; background-color: #0b1a29; border: 1px solid #1e3a5f; border-radius: 12px; overflow: hidden;">
        <div style="background: linear-gradient(135deg, #071e3d 0%, #0d2847 100%); padding: 32px 24px; text-align: center; border-bottom: 2px solid #ff8a00;">
            <a href="https://photox.co.za" style="text-decoration: none; display: inline-block;">
                <img src="https://photox.co.za/logo.png" alt="PhotoX" style="height: 48px; width: auto; max-width: 220px; display: inline-block; border: 0;" />
            </a>
            <p style="color: #94a3b8; margin: 8px 0 0; font-size: 13px; letter-spacing: 0.5px;">Official Sports Photography &amp; Protected Gallery</p>
        </div>
        <div style="padding: 32px 28px;">
            <p style="color: #38bdf8; font-size: 13px; font-weight: 700; text-transform: uppercase; margin: 0 0 8px 0;">Gallery Live Alert</p>
            <h2 style="color: #ffffff; font-size: 20px; margin: 0 0 16px 0;">Photos for {$eventTitle} are now available!</h2>
            <p style="color: #cbd5e1; font-size: 15px; line-height: 1.6; margin: 0 0 20px 0;">
                Great news! The official high-resolution photo collection for <strong style="color: #f59e0b;">{$eventTitle}</strong> has just been uploaded to PhotoX.
            </p>
            <div style="text-align: center; margin: 30px 0;">
                <a href="{$eventUrl}" style="background-color: #ff8a00; color: #000000; font-weight: 700; text-decoration: none; padding: 14px 32px; border-radius: 8px; font-size: 15px; display: inline-block;">
                    View &amp; Find Your Photos &rarr;
                </a>
            </div>
            <p style="color: #94a3b8; font-size: 13px; line-height: 1.5; margin: 0;">
                You received this email because you asked to be notified when photos for this event were published.
            </p>
        </div>
        <div style="background-color: #06111c; padding: 18px 24px; text-align: center; border-top: 1px solid #192c3f;">
            <p style="color: #64748b; font-size: 12px; margin: 0;">&copy; 2026 PhotoX (Pty) Ltd · South Africa · All Rights Reserved</p>
        </div>
    </div>
</body>
</html>
HTML;
                Mail::html($html, function ($message) use ($toEmail, $subject) {
                    $message->to($toEmail)->subject($subject);
                });

                DB::table('event_notifications')
                    ->where('id', $sub->id)
                    ->update(['notified_at' => now(), 'updated_at' => now()]);

                $count++;
            } catch (\Throwable $e) {
                Log::error("Failed to send gallery notification to {$sub->email}: ".$e->getMessage());
            }
        }

        return $count;
    }

    /**
     * Real-time autocomplete quick search for top navbar.
     */
    public function quickSearch(Request $request): JsonResponse
    {
        $q = trim((string) $request->input('q', ''));
        if (mb_strlen($q) < 2) {
            return response()->json([
                'events' => [],
                'photographers' => [],
                'categories' => [],
                'total' => 0,
            ]);
        }

        // 1. Search matching published events
        $events = Event::where('status', 'published')
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%")
                    ->orWhere('category_name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('photographer_name', 'like', "%{$q}%");
            })
            ->latest('event_date')
            ->take(5)
            ->get(['id', 'title', 'slug', 'location', 'event_date', 'category_name', 'cover_image', 'total_photos'])
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'url' => url('/event-details/'.($event->slug ?: $event->id)),
                    'date' => $event->event_date ? date('d M Y', strtotime($event->event_date)) : '',
                    'location' => $event->location,
                    'category' => $event->category_name,
                    'image' => $event->cover_image,
                    'photos_count' => $event->total_photos,
                ];
            });

        // 2. Search matching photographers
        $photographers = User::where('role', 'photographer')
            ->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('specialty', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%");
            })
            ->take(3)
            ->get(['id', 'name', 'avatar', 'specialty', 'slug'])
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'url' => ! empty($p->slug) ? url('/'.$p->slug) : url('/photographers?q='.urlencode($p->name)),
                    'specialty' => $p->specialty,
                    'avatar' => $p->avatar ?: null,
                ];
            });

        // 3. Search matching sports / categories
        $categories = Category::where('is_active', true)
            ->where('name', 'like', "%{$q}%")
            ->take(3)
            ->get(['id', 'name', 'slug'])
            ->map(function ($c) {
                return [
                    'name' => $c->name,
                    'url' => url('/events?category='.urlencode($c->slug ?: $c->name)),
                ];
            });

        return response()->json([
            'events' => $events,
            'photographers' => $photographers,
            'categories' => $categories,
            'total' => $events->count() + $photographers->count() + $categories->count(),
            'view_all_url' => url('/events?q='.urlencode($q)),
        ]);
    }
}
