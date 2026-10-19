<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalPageController extends Controller
{
    public function index(Request $request)
    {
        $pages = LegalPage::all();
        $selectedSlug = $request->input('tab', 'terms');
        $currentPage = $pages->firstWhere('slug', $selectedSlug) ?? $pages->first();

        return view('admin.legal-pages', compact('pages', 'currentPage', 'selectedSlug'));
    }

    public function update(Request $request, LegalPage $legalPage)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'last_updated' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $legalPage->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'content' => $validated['content'],
            'last_updated' => $validated['last_updated'] ?? now()->format('F Y'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.legal.index', ['tab' => $legalPage->slug])
            ->with('success', "{$legalPage->title} updated successfully.");
    }
}
