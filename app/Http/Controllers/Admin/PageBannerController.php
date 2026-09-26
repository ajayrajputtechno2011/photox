<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageHero;
use Illuminate\Http\Request;

class PageBannerController extends Controller
{
    public function index(Request $request)
    {
        $heroes = PageHero::all()->keyBy('page_key');
        $activeTab = $request->input('tab', 'events');

        return view('admin.page-banners', compact('heroes', 'activeTab'));
    }

    public function update(Request $request, PageHero $pageHero)
    {
        $validated = $request->validate([
            'kicker' => 'nullable|string|max:255',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'primary_button_text' => 'nullable|string|max:100',
            'primary_button_url' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:100',
            'secondary_button_url' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:100',
            'image_url' => 'nullable|string|max:1000',
            'image_file' => 'nullable|image|max:10240',
            'story_title' => 'nullable|string|max:255',
            'story_description' => 'nullable|string',
        ]);

        $imageUrl = $validated['image_url'] ?? $pageHero->image_url;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('page_heroes', 'public');
            $imageUrl = '/storage/'.$path;
        }

        $extraData = $pageHero->extra_data ?? [];
        if ($request->filled('story_title')) {
            $extraData['story_title'] = $validated['story_title'];
        }
        if ($request->filled('story_description')) {
            $extraData['story_description'] = $validated['story_description'];
        }

        $pageHero->update([
            'kicker' => $validated['kicker'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'primary_button_text' => $validated['primary_button_text'] ?? null,
            'primary_button_url' => $validated['primary_button_url'] ?? null,
            'secondary_button_text' => $validated['secondary_button_text'] ?? null,
            'secondary_button_url' => $validated['secondary_button_url'] ?? null,
            'badge_text' => $validated['badge_text'] ?? null,
            'image_url' => $imageUrl,
            'extra_data' => $extraData,
        ]);

        return redirect()->route('admin.page-banners.index', ['tab' => $pageHero->page_key])
            ->with('success', "Hero banner for '{$pageHero->page_name}' updated successfully.");
    }
}
