<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('category')->latest('event_date');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('category_name', 'like', "%{$search}%");
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

        return view('admin.add-event', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'sport' => 'nullable|string|max:100',
            'location' => 'required|string|max:255',
            'event_date' => 'nullable|date',
            'starting_price' => 'nullable|string|max:50',
            'total_photos' => 'nullable|integer',
            'photographers_count' => 'nullable|integer',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|string|max:1000',
            'cover_file' => 'nullable|image|max:10240',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:published,draft,archived',
        ]);

        $coverImage = $validated['cover_image'] ?? 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=900&q=80';
        if ($request->hasFile('cover_file')) {
            $path = $request->file('cover_file')->store('events', 'public');
            $coverImage = '/storage/'.$path;
        }

        $categoryName = $validated['sport'] ?? null;
        if (! empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            if ($cat) {
                $categoryName = $cat->name;
            }
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
            'category_id' => $validated['category_id'] ?? null,
            'category_name' => $categoryName ?? 'Sport',
            'location' => $validated['location'],
            'event_date' => $validated['event_date'] ?? now()->toDateString(),
            'starting_price' => $validated['starting_price'] ?? 'From R90',
            'total_photos' => $validated['total_photos'] ?? 0,
            'photographers_count' => $validated['photographers_count'] ?? 1,
            'description' => $validated['description'] ?? null,
            'cover_image' => $coverImage,
            'is_featured' => $request->has('is_featured'),
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
