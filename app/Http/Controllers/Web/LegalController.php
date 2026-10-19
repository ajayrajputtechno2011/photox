<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use App\Models\PageHero;
use Illuminate\View\View;

class LegalController extends Controller
{
    /**
     * Display a specific legal policy page.
     */
    public function show(string $slug = 'terms'): View
    {
        $allPages = LegalPage::where('is_active', true)->get()->keyBy('slug');
        $currentPage = $allPages->get($slug) ?? LegalPage::where('slug', 'terms')->first();

        if (! $currentPage) {
            abort(404, 'Legal policy not found.');
        }

        $pageHeroes = PageHero::all()->keyBy('page_key');

        return view('web.legal', compact('currentPage', 'allPages', 'slug', 'pageHeroes'));
    }

    public function terms(): View
    {
        return $this->show('terms');
    }

    public function privacy(): View
    {
        return $this->show('privacy');
    }

    public function licensing(): View
    {
        return $this->show('licensing');
    }
}
