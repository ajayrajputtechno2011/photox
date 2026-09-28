<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'slug' => 'starter',
                'badge' => 'Starter',
                'tagline' => 'Try PhotoX with no commitment.',
                'monthly_price' => 0.00,
                'yearly_price' => 0.00,
                'currency' => 'R',
                'price_display' => 'forever',
                'commission_rate' => '16%',
                'storage_limit' => '25 GB',
                'features_included_title' => 'INCLUDED IN STARTER:',
                'features' => [
                    'Bulk photo upload',
                    'AI face & bib number recognition',
                    'Athlete selfie search',
                    'Clothing color search (Beta)',
                    'Mobile app for photographers',
                    'Custom watermark',
                    'Private albums with your branding',
                    'Direct messages (3 free/month)',
                    'Video uploads',
                    'Email support',
                ],
                'is_featured' => false,
                'theme_style' => 'light',
                'button_text' => 'Start free',
                'button_url' => '/signup',
                'subscribers_count' => 142,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Standard',
                'slug' => 'standard',
                'badge' => 'Standard',
                'tagline' => 'For photographers covering a few races a year.',
                'monthly_price' => 199.00,
                'yearly_price' => 1990.00,
                'currency' => 'R',
                'price_display' => null,
                'commission_rate' => '13%',
                'storage_limit' => '100 GB',
                'features_included_title' => 'EVERYTHING IN STARTER, PLUS:',
                'features' => [
                    'Unlimited direct messages',
                    'Gift free photos to your athletes',
                    'Unlimited album retention',
                    'Custom domain for your profile',
                    'Email support',
                ],
                'is_featured' => false,
                'theme_style' => 'light',
                'button_text' => 'Choose Standard',
                'button_url' => '/signup',
                'subscribers_count' => 88,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'badge' => 'Pro',
                'tagline' => 'For photographers shooting every weekend.',
                'monthly_price' => 399.00,
                'yearly_price' => 3990.00,
                'currency' => 'R',
                'price_display' => null,
                'commission_rate' => '7%',
                'storage_limit' => '500 GB',
                'features_included_title' => 'EVERYTHING IN STANDARD, PLUS:',
                'features' => [
                    'Face & bib recognition in videos (60 min/month)',
                    'Priority support',
                ],
                'is_featured' => true,
                'theme_style' => 'featured',
                'button_text' => 'Choose Pro',
                'button_url' => '/signup',
                'subscribers_count' => 215,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Custom',
                'slug' => 'custom',
                'badge' => 'Custom',
                'tagline' => 'For high-volume teams and custom workflows.',
                'monthly_price' => null,
                'yearly_price' => null,
                'currency' => 'R',
                'price_display' => 'quote',
                'commission_rate' => '5%',
                'storage_limit' => '2 TB',
                'features_included_title' => 'EVERYTHING IN PRO, PLUS:',
                'features' => [
                    'Face & bib recognition in videos (120 min/month)',
                    'Custom features on request',
                    'Dedicated support with faster response',
                ],
                'is_featured' => false,
                'theme_style' => 'custom',
                'button_text' => 'Request a quote',
                'button_url' => '/contact',
                'subscribers_count' => 19,
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($plans as $planData) {
            Membership::updateOrCreate(
                ['slug' => $planData['slug']],
                $planData
            );
        }
    }
}
