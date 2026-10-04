<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categories
        $categoriesData = [
            [
                'name' => 'Rugby',
                'icon' => 'bi-trophy',
                'description' => 'School finals, club fixtures and tournament highlights.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Running',
                'icon' => 'bi-lightning-charge',
                'description' => 'Road races, relay events and finish-line stories.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Cycling',
                'icon' => 'bi-bicycle',
                'description' => 'Open-road rides, mountain trails and endurance races.',
                'sort_order' => 3,
            ],
            [
                'name' => 'School sport',
                'icon' => 'bi-people',
                'description' => 'Community fixtures, finals and campus event photos.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Football',
                'icon' => 'bi-dribbble',
                'description' => 'Youth tournaments, league matches and cup finals.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Swimming',
                'icon' => 'bi-water',
                'description' => 'Open water sprints, gala championships and pool meets.',
                'sort_order' => 6,
            ],
            [
                'name' => 'Tennis',
                'icon' => 'bi-circle',
                'description' => 'Club championships, grand prix and school derbies.',
                'sort_order' => 7,
            ],
            [
                'name' => 'Hockey',
                'icon' => 'bi-shield-shaded',
                'description' => 'Turf tournaments, varsity derbies and provincial series.',
                'sort_order' => 8,
            ],
        ];

        $categoryMap = [];
        foreach ($categoriesData as $cat) {
            $category = Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'icon' => $cat['icon'],
                    'description' => $cat['description'],
                    'sort_order' => $cat['sort_order'],
                    'is_active' => true,
                ]
            );
            $categoryMap[$cat['name']] = $category->id;
        }

        // 2. Banners (Hero Ads)
        $bannersData = [
            [
                'title' => "BUILT FOR MORE\nTHAN ROADS",
                'subtitle' => 'Explore the range',
                'badge_text' => 'BANNER ADS',
                'image_url' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88',
                'link_url' => '/events',
                'placement' => 'events_hero',
                'sort_order' => 1,
            ],
            [
                'title' => 'KEEP MOVING.',
                'subtitle' => 'Performance partner',
                'badge_text' => 'BANNER ADS',
                'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&h=1200&q=88',
                'link_url' => '/events',
                'placement' => 'events_hero',
                'sort_order' => 2,
            ],
            [
                'title' => 'MAKE A SPLASH.',
                'subtitle' => 'Discover the next event',
                'badge_text' => 'BANNER ADS',
                'image_url' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=700&h=1200&q=88',
                'link_url' => '/events',
                'placement' => 'events_hero',
                'sort_order' => 3,
            ],
            [
                'title' => 'SPRINGBOKS IN ACTION.',
                'subtitle' => 'Official Rugby Gear & Photos',
                'badge_text' => 'RUGBY SPONSOR',
                'image_url' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=700&h=1200&q=88',
                'link_url' => '/events?category=Rugby',
                'placement' => 'events_hero',
                'category_name' => 'Rugby',
                'sort_order' => 4,
            ],
        ];

        foreach ($bannersData as $b) {
            Banner::updateOrCreate(
                ['title' => $b['title'], 'placement' => $b['placement']],
                [
                    'subtitle' => $b['subtitle'],
                    'badge_text' => $b['badge_text'],
                    'image_url' => $b['image_url'],
                    'link_url' => $b['link_url'],
                    'category_name' => $b['category_name'] ?? null,
                    'sort_order' => $b['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        // 3. Events
        $eventsData = [
            [
                'title' => 'City Marathon 2026',
                'category_name' => 'Running',
                'location' => 'Cape Town',
                'event_date' => '2026-09-14',
                'starting_price' => 'From R90',
                'total_photos' => 24812,
                'photographers_count' => 8,
                'description' => 'Cape Town annual city marathon capturing runners across the iconic coastline.',
                'cover_image' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
            ],
            [
                'title' => 'Maties vs Ikeys',
                'category_name' => 'Rugby',
                'location' => 'Stellenbosch',
                'event_date' => '2026-09-12',
                'starting_price' => 'From R120',
                'total_photos' => 8430,
                'photographers_count' => 5,
                'description' => 'Varsity rugby derby between historical rivals with intense physical gameplay.',
                'cover_image' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
            ],
            [
                'title' => 'Winelands Cycle Tour',
                'category_name' => 'Cycling',
                'location' => 'Paarl',
                'event_date' => '2026-09-06',
                'starting_price' => 'From R95',
                'total_photos' => 16205,
                'photographers_count' => 10,
                'description' => 'Scenic wine valley road race through steep passes and vineyards.',
                'cover_image' => 'https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
            ],
            [
                'title' => 'U18 Final Cup',
                'category_name' => 'Football',
                'location' => 'Johannesburg',
                'event_date' => '2026-09-20',
                'starting_price' => 'From R75',
                'total_photos' => 4680,
                'photographers_count' => 6,
                'description' => 'Final day highlights of the provincial youth championship.',
                'cover_image' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=900&q=80',
                'is_featured' => false,
            ],
            [
                'title' => 'Varsity Clash',
                'category_name' => 'School sport',
                'location' => 'Pretoria',
                'event_date' => '2026-09-18',
                'starting_price' => 'From R82',
                'total_photos' => 7120,
                'photographers_count' => 9,
                'description' => 'Inter-school sports derby featuring athletics, soccer, and hockey.',
                'cover_image' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=900&q=80',
                'is_featured' => false,
            ],
            [
                'title' => 'Coastal Rugby 7s',
                'category_name' => 'Rugby',
                'location' => 'Durban',
                'event_date' => '2026-09-15',
                'starting_price' => 'From R99',
                'total_photos' => 9405,
                'photographers_count' => 11,
                'description' => 'Fast-paced sevens tournament along the golden coast.',
                'cover_image' => 'https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=900&q=80',
                'is_featured' => false,
            ],
            [
                'title' => 'Open Water Sprint',
                'category_name' => 'Swimming',
                'location' => 'Cape Town',
                'event_date' => '2026-09-10',
                'starting_price' => 'From R68',
                'total_photos' => 2776,
                'photographers_count' => 4,
                'description' => 'Cold water open ocean swimming race with dramatic swell action.',
                'cover_image' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=900&q=80',
                'is_featured' => false,
            ],
            [
                'title' => 'Mountain Trail Classic',
                'category_name' => 'Cycling',
                'location' => 'Paarl',
                'event_date' => '2026-09-05',
                'starting_price' => 'From R88',
                'total_photos' => 5890,
                'photographers_count' => 7,
                'description' => 'Rugged mountain bike marathon traversing gravel ridges and pine forests.',
                'cover_image' => 'https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=900&q=80',
                'is_featured' => false,
            ],
            [
                'title' => 'Coastal Cross Challenge',
                'category_name' => 'Running',
                'location' => 'Gqeberha',
                'event_date' => '2026-09-02',
                'starting_price' => 'From R72',
                'total_photos' => 3410,
                'photographers_count' => 5,
                'description' => 'Cross-country trail event tested over sand dunes and dirt paths.',
                'cover_image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=900&q=80',
                'is_featured' => false,
            ],
        ];

        foreach ($eventsData as $ev) {
            $catId = $categoryMap[$ev['category_name']] ?? null;
            Event::updateOrCreate(
                ['slug' => Str::slug($ev['title'])],
                [
                    'title' => $ev['title'],
                    'category_id' => $catId,
                    'category_name' => $ev['category_name'],
                    'location' => $ev['location'],
                    'event_date' => $ev['event_date'],
                    'starting_price' => $ev['starting_price'],
                    'total_photos' => $ev['total_photos'],
                    'photographers_count' => $ev['photographers_count'],
                    'description' => $ev['description'],
                    'cover_image' => $ev['cover_image'],
                    'is_featured' => $ev['is_featured'],
                    'status' => 'published',
                ]
            );
        }
    }
}
