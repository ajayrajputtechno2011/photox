<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\MediaAsset;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $query = Banner::with('category')->orderBy('placement')->orderBy('sort_order');

        if ($request->filled('placement')) {
            $query->where('placement', $request->input('placement'));
        }

        if ($request->filled('category')) {
            $query->where('category_name', $request->input('category'));
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $banners = $query->paginate(15);
        $totalCount = Banner::count();
        $activeCount = Banner::where('is_active', true)->count();
        $categories = Category::where('is_active', true)->orderBy('name', 'asc')->get();

        return view('admin.banners', compact('banners', 'totalCount', 'activeCount', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:100',
            'image_url' => 'nullable|string|max:1000',
            'image_file' => 'nullable|image|max:10240', // 10MB
            'link_url' => 'nullable|string|max:255',
            'placement' => 'required|string|max:50',
            'category_id' => 'nullable|exists:categories,id',
            'sort_order' => 'nullable|integer',
            'rotation_interval' => 'nullable|integer|min:1|max:300',
            'is_active' => 'nullable|boolean',
        ]);

        $imageUrl = $validated['image_url'] ?? '';

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('banners', 'public');
            $imageUrl = '/storage/'.$path;
            MediaAsset::firstOrCreate(
                ['file_path' => $imageUrl],
                [
                    'filename' => basename($path),
                    'original_name' => $request->file('image_file')->getClientOriginalName(),
                    'disk' => 'public',
                    'mime_type' => $request->file('image_file')->getClientMimeType(),
                    'file_size' => $request->file('image_file')->getSize(),
                    'title' => $validated['title'] ?? 'Banner Creative',
                    'folder' => 'banners',
                ]
            );
        } elseif ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $imageUrl = '/storage/'.$path;
            MediaAsset::firstOrCreate(
                ['file_path' => $imageUrl],
                [
                    'filename' => basename($path),
                    'original_name' => $request->file('image')->getClientOriginalName(),
                    'disk' => 'public',
                    'mime_type' => $request->file('image')->getClientMimeType(),
                    'file_size' => $request->file('image')->getSize(),
                    'title' => $validated['title'] ?? 'Banner Creative',
                    'folder' => 'banners',
                ]
            );
        }

        if (empty($imageUrl)) {
            return back()->withInput()->with('error', 'Please provide either an Image URL or upload an image file.');
        }

        $categoryName = null;
        if (! empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            if ($cat) {
                $categoryName = $cat->name;
            }
        }

        Banner::create([
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'badge_text' => $validated['badge_text'] ?? null,
            'image_url' => $imageUrl,
            'link_url' => $validated['link_url'] ?? '/events',
            'placement' => $validated['placement'] ?? 'events_hero',
            'category_id' => $validated['category_id'] ?? null,
            'category_name' => $categoryName,
            'sort_order' => $validated['sort_order'] ?? (Banner::max('sort_order') + 1),
            'rotation_interval' => ! empty($validated['rotation_interval']) ? (int) $validated['rotation_interval'] : 5,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:100',
            'image_url' => 'nullable|string|max:1000',
            'image_file' => 'nullable|image|max:10240',
            'link_url' => 'nullable|string|max:255',
            'placement' => 'required|string|max:50',
            'category_id' => 'nullable|exists:categories,id',
            'sort_order' => 'nullable|integer',
            'rotation_interval' => 'nullable|integer|min:1|max:300',
            'is_active' => 'nullable|boolean',
        ]);

        $imageUrl = $banner->image_url;

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('banners', 'public');
            $imageUrl = '/storage/'.$path;
            MediaAsset::firstOrCreate(
                ['file_path' => $imageUrl],
                [
                    'filename' => basename($path),
                    'original_name' => $request->file('image_file')->getClientOriginalName(),
                    'disk' => 'public',
                    'mime_type' => $request->file('image_file')->getClientMimeType(),
                    'file_size' => $request->file('image_file')->getSize(),
                    'title' => $validated['title'] ?? ($banner->title ?: 'Banner Creative'),
                    'folder' => 'banners',
                ]
            );
        } elseif ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $imageUrl = '/storage/'.$path;
            MediaAsset::firstOrCreate(
                ['file_path' => $imageUrl],
                [
                    'filename' => basename($path),
                    'original_name' => $request->file('image')->getClientOriginalName(),
                    'disk' => 'public',
                    'mime_type' => $request->file('image')->getClientMimeType(),
                    'file_size' => $request->file('image')->getSize(),
                    'title' => $validated['title'] ?? ($banner->title ?: 'Banner Creative'),
                    'folder' => 'banners',
                ]
            );
        } elseif (! empty($validated['image_url'])) {
            $imageUrl = $validated['image_url'];
        }

        $categoryName = null;
        if (! empty($validated['category_id'])) {
            $cat = Category::find($validated['category_id']);
            if ($cat) {
                $categoryName = $cat->name;
            }
        }

        $banner->update([
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'badge_text' => $validated['badge_text'] ?? null,
            'image_url' => $imageUrl,
            'link_url' => $validated['link_url'] ?? $banner->link_url,
            'placement' => $validated['placement'] ?? $banner->placement,
            'category_id' => $validated['category_id'] ?? null,
            'category_name' => $categoryName,
            'sort_order' => $validated['sort_order'] ?? $banner->sort_order,
            'rotation_interval' => ! empty($validated['rotation_interval']) ? (int) $validated['rotation_interval'] : ($banner->rotation_interval ?? 5),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function toggleStatus(Banner $banner)
    {
        $banner->update(['is_active' => ! $banner->is_active]);

        $statusStr = $banner->is_active ? 'activated' : 'deactivated';

        return redirect()->route('admin.banners.index')->with('success', "Banner #{$banner->id} {$statusStr}.");
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
