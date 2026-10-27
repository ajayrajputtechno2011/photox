<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What is PhotoX and how does it work?',
                'answer' => 'PhotoX is South Africa\'s premier digital sports and event photography marketplace. We connect professional sports photographers with athletes, families, clubs, and schools. Photographers upload high-resolution event galleries, and athletes can effortlessly find their photos using AI Face Recognition (Selfie Search) or Bib Number lookup.',
                'category' => 'general',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'How does the Selfie / Athlete Bundle work?',
                'answer' => 'The Selfie / Athlete Bundle allows an athlete or parent to upload a quick selfie. Our advanced biometric AI instantly scans the entire event gallery and groups every single photo where that athlete appears. You can then purchase all of your matched photos together as a discounted bundle under a Personal Digital License.',
                'category' => 'selfie_bundles',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'What is the difference between a Personal License and a Commercial License?',
                'answer' => 'A Personal License allows you to use the photo for personal social media (Instagram, Facebook, TikTok), personal prints, family albums, and digital keepsakes. Commercial Licenses are for businesses, sponsors, brands, marketing campaigns, websites, advertising, and editorial print publications. Commercial licenses must always be purchased individually per photo.',
                'category' => 'licenses',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Can I buy just a single photo or do I have to buy the whole bundle?',
                'answer' => 'For most events, you have full flexibility! You can purchase individual photos under a Personal or Commercial license, or choose the discounted Selfie / Athlete Bundle. Note: If a photographer or school specifies "Sell Complete Gallery ONLY" for a private album, all photos are packaged together in a single complete gallery checkout.',
                'category' => 'orders',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'How do I download my photos after purchasing?',
                'answer' => 'Immediately after completing checkout via our secure Yoco payment gateway, you are redirected to your order confirmation page with instant download links. The download links are also emailed to you and permanently accessible in your Customer Account under "My Orders & Downloads". All purchased photos are delivered at full original camera resolution without watermarks.',
                'category' => 'orders',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'How do photographers join PhotoX and publish galleries?',
                'answer' => 'Photographers can register for a Creator Account via our Sign Up page. Once approved, you gain access to the Creator Studio where you can bulk upload photos, set custom pricing rules, customize anti-theft watermarks, manage payouts to any South African bank, and claim your custom vanity URL (photox.co.za/@yourhandle).',
                'category' => 'photographers',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept all major South African and international Visa and Mastercard debit and credit cards via Yoco\'s PCI-DSS Level 1 compliant secure payment gateway. We also support Instant EFT and digital wallet payments.',
                'category' => 'orders',
                'order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $item) {
            Faq::updateOrCreate(
                ['question' => $item['question']],
                $item
            );
        }
    }
}
