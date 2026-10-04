<?php

namespace Database\Seeders;

use App\Models\PageHero;
use Illuminate\Database\Seeder;

class PageHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroes = [
            [
                'page_key' => 'home',
                'page_name' => 'Home',
                'kicker' => 'PhotoX Marketplace',
                'title' => 'The feeling of being there,<br><em>kept in a frame.</em>',
                'description' => 'Discover upcoming events, explore galleries and find your moments captured by vetted professional sports photographers.',
                'primary_button_text' => 'Browse events',
                'primary_button_url' => '/events',
                'secondary_button_text' => 'Find your photos',
                'secondary_button_url' => '/events#discover',
                'image_url' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1200&q=80',
                'badge_text' => 'Live Archive',
            ],
            [
                'page_key' => 'events',
                'page_name' => 'Explore / Events',
                'kicker' => 'Live archive',
                'title' => 'Find the moment. <em>Then keep it.</em>',
                'description' => 'Explore premium sports and event galleries across the country. From city marathons to school finals, every listing is designed to make browsing and buying photos simple, secure and fast.',
                'primary_button_text' => 'Browse events',
                'primary_button_url' => '#discover',
                'secondary_button_text' => 'Create account',
                'secondary_button_url' => '/signup',
                'image_url' => null,
                'badge_text' => 'Live archive',
            ],
            [
                'page_key' => 'photographers',
                'page_name' => 'Photographers',
                'kicker' => 'PhotoX / The Photographers',
                'title' => 'Good eyes. <em>see more.</em>',
                'description' => 'Meet the photographers behind the moments. From race days to match days, they capture movement, emotion and stories that last. Find the right creative eye for your next event.',
                'primary_button_text' => 'Meet the roster',
                'primary_button_url' => '#discover',
                'secondary_button_text' => 'Join as creator',
                'secondary_button_url' => '/signup',
                'image_url' => null,
                'badge_text' => 'Creator Network',
            ],
            [
                'page_key' => 'membership',
                'page_name' => 'Membership',
                'kicker' => 'Membership plans',
                'title' => 'Pick a plan that grows with your work.',
                'description' => 'PhotoX buyer accounts are free. These creator plans are for photographers and studios who want to showcase, sell and scale with confidence.',
                'primary_button_text' => 'Compare plans',
                'primary_button_url' => '#plans',
                'secondary_button_text' => 'Create a free account',
                'secondary_button_url' => '/signup',
                'image_url' => null,
                'badge_text' => 'Pricing Tiers',
            ],
            [
                'page_key' => 'about',
                'page_name' => 'About',
                'kicker' => 'About PhotoX',
                'title' => 'Stories that <em>last longer.</em>',
                'description' => 'PhotoX brings athletes, families, clubs, schools and sponsors into one elegant digital storefront for sports and event photography. Our focus is simple: make outstanding images easy to discover, easy to buy and easy to revisit.',
                'primary_button_text' => 'Explore events',
                'primary_button_url' => '/events',
                'secondary_button_text' => 'Meet creators',
                'secondary_button_url' => '/photographers',
                'image_url' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1200&q=80',
                'badge_text' => 'Our Mission',
                'extra_data' => [
                    'story_badge' => 'Featured story',
                    'story_date' => 'April 2026',
                    'story_title' => 'How sports clubs are turning match-day moments into lasting memories.',
                    'story_description' => 'From grassroots school fixtures to city marathons, galleries increasingly live beyond the event itself.',
                ],
            ],
            [
                'page_key' => 'contact',
                'page_name' => 'Contact',
                'kicker' => 'Contact PhotoX',
                'title' => 'Let’s talk about<br><em>your next frame.</em>',
                'description' => 'Questions about a gallery, a photographer membership or your next event? Our team is ready to help.',
                'primary_button_text' => 'Contact Us',
                'primary_button_url' => '#contact',
                'secondary_button_text' => null,
                'secondary_button_url' => null,
                'image_url' => null,
                'badge_text' => 'Get In Touch',
            ],
        ];

        foreach ($heroes as $hero) {
            PageHero::updateOrCreate(
                ['page_key' => $hero['page_key']],
                $hero
            );
        }
    }
}
