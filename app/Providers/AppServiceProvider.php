<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\PageHero;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Share hero banners and page heroes across all views if database tables exist
        try {
            if (Schema::hasTable('banners')) {
                View::composer('*', function ($view) {
                    $categoryFilter = request('category');
                    $baseQuery = Banner::where('is_active', true)
                        ->where('placement', 'events_hero')
                        ->orderBy('sort_order');

                    if (! empty($categoryFilter) && $categoryFilter !== 'All categories') {
                        $targeted = Banner::where('is_active', true)
                            ->where('placement', 'events_hero')
                            ->where(function ($q) use ($categoryFilter) {
                                $q->where('category_name', $categoryFilter)
                                    ->orWhereHas('category', function ($sub) use ($categoryFilter) {
                                        $sub->where('slug', $categoryFilter)
                                            ->orWhere('name', $categoryFilter);
                                    });
                            })
                            ->orderBy('sort_order')
                            ->get();

                        // Global banners (not assigned to any specific category) should display on all categories
                        $globalBanners = Banner::where('is_active', true)
                            ->where('placement', 'events_hero')
                            ->whereNull('category_id')
                            ->where(function ($q) {
                                $q->whereNull('category_name')->orWhere('category_name', '');
                            })
                            ->orderBy('sort_order')
                            ->get();

                        $combined = $targeted->concat($globalBanners);

                        if ($combined->isNotEmpty()) {
                            $view->with('heroBanners', $combined);

                            return;
                        }
                    }

                    $heroBanners = $baseQuery->get();
                    $view->with('heroBanners', $heroBanners);
                });
            }

            if (Schema::hasTable('page_heroes')) {
                View::composer('*', function ($view) {
                    $pageHeroes = PageHero::all()->keyBy('page_key');
                    $view->with('pageHeroes', $pageHeroes);
                });
            }

            if (Schema::hasTable('categories')) {
                View::composer('web.*', function ($view) {
                    if (! $view->offsetExists('categories')) {
                        $categories = Category::where('is_active', true)
                            ->orderBy('name', 'asc')
                            ->get();
                        $view->with('categories', $categories);
                    }
                });
            }
        } catch (\Throwable $e) {
            // Failsafe in case database connection is not ready during early bootstrap
        }
    }
}
