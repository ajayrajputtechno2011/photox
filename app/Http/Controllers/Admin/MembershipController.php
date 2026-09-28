<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::orderBy('sort_order')->orderBy('id')->get();
        $totalPlans = $memberships->count();
        $activePlans = $memberships->where('is_active', true)->count();
        $totalSubscribers = $memberships->sum('subscribers_count');

        return view('admin.memberships', compact(
            'memberships',
            'totalPlans',
            'activePlans',
            'totalSubscribers'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'badge' => 'nullable|string|max:100',
            'tagline' => 'nullable|string|max:255',
            'monthly_price' => 'nullable|numeric|min:0',
            'yearly_price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'price_display' => 'nullable|string|max:50',
            'commission_rate' => 'nullable|string|max:50',
            'storage_limit' => 'nullable|string|max:50',
            'features_included_title' => 'nullable|string|max:100',
            'features_text' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'theme_style' => 'required|in:light,featured,custom',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $features = [];
        if (! empty($validated['features_text'])) {
            $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features_text']))));
        }

        $slug = Str::slug($validated['name']);
        $baseSlug = $slug;
        $counter = 1;
        while (Membership::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        Membership::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'badge' => $validated['badge'] ?? $validated['name'],
            'tagline' => $validated['tagline'],
            'monthly_price' => $validated['monthly_price'],
            'yearly_price' => $validated['yearly_price'],
            'currency' => $validated['currency'] ?? 'R',
            'price_display' => $validated['price_display'],
            'commission_rate' => $validated['commission_rate'] ?? '10%',
            'storage_limit' => $validated['storage_limit'] ?? '50 GB',
            'features_included_title' => $validated['features_included_title'] ?? 'INCLUDED IN PLAN:',
            'features' => $features,
            'is_featured' => $request->has('is_featured'),
            'theme_style' => $validated['theme_style'],
            'button_text' => $validated['button_text'] ?? 'Choose Plan',
            'button_url' => $validated['button_url'] ?? '/signup',
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.memberships.index')->with('success', 'Membership plan created successfully.');
    }

    public function update(Request $request, Membership $membership)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'badge' => 'nullable|string|max:100',
            'tagline' => 'nullable|string|max:255',
            'monthly_price' => 'nullable|numeric|min:0',
            'yearly_price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'price_display' => 'nullable|string|max:50',
            'commission_rate' => 'nullable|string|max:50',
            'storage_limit' => 'nullable|string|max:50',
            'features_included_title' => 'nullable|string|max:100',
            'features_text' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'theme_style' => 'required|in:light,featured,custom',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $features = [];
        if (isset($validated['features_text'])) {
            $features = array_values(array_filter(array_map('trim', explode("\n", $validated['features_text']))));
        }

        $membership->update([
            'name' => $validated['name'],
            'badge' => $validated['badge'] ?? $validated['name'],
            'tagline' => $validated['tagline'],
            'monthly_price' => $validated['monthly_price'],
            'yearly_price' => $validated['yearly_price'],
            'currency' => $validated['currency'] ?? 'R',
            'price_display' => $validated['price_display'],
            'commission_rate' => $validated['commission_rate'],
            'storage_limit' => $validated['storage_limit'],
            'features_included_title' => $validated['features_included_title'],
            'features' => $features,
            'is_featured' => $request->has('is_featured'),
            'theme_style' => $validated['theme_style'],
            'button_text' => $validated['button_text'] ?? 'Choose Plan',
            'button_url' => $validated['button_url'] ?? '/signup',
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.memberships.index')->with('success', "Membership plan '{$membership->name}' updated successfully.");
    }

    public function toggleStatus(Membership $membership)
    {
        $membership->update(['is_active' => ! $membership->is_active]);

        $statusStr = $membership->is_active ? 'activated' : 'deactivated';

        return redirect()->route('admin.memberships.index')->with('success', "Plan '{$membership->name}' {$statusStr}.");
    }

    public function destroy(Membership $membership)
    {
        $name = $membership->name;
        $membership->delete();

        return redirect()->route('admin.memberships.index')->with('success', "Membership plan '{$name}' deleted successfully.");
    }
}
