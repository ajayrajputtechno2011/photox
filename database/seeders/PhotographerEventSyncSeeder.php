<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PhotographerEventSyncSeeder extends Seeder
{
    /**
     * Run the database seeds to synchronize 6 photographers and their 2 events each.
     */
    public function run(): void
    {
        $proPlan = Membership::where('slug', 'pro')->first();
        $starterPlan = Membership::where('slug', 'starter')->first();
        $standardPlan = Membership::where('slug', 'standard')->first();
        $guildPlan = Membership::where('slug', 'photoguild')->first();

        // 1. Define the exactly 6 photographers
        $photographersConfig = [
            [
                'email' => 'aiden@photox.com',
                'name' => 'Aiden Daniels',
                'tier' => 'pro',
                'membership_id' => $proPlan?->id,
                'phone' => '+27 21 555 0192',
                'location' => 'Cape Town, South Africa',
                'specialty' => 'Running, Marathons & Track',
                'avatar' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=600&q=90',
                'bio' => 'Documentary sports photography for the split second, the quiet build-up and everything that happens after the finish line. Based in Cape Town, covering marathons, track & road running.',
                'verification_badge' => 'Pro Member',
                'custom_features' => ['ai_search', 'custom_watermark', 'direct_messages', 'priority_support'],
                'payout_email' => 'payouts@aidendaniels.co.za',
                'payout_method' => 'Bank Transfer · Standard Bank (SA)',
                'admin_notes' => 'Accredited sports documentary photographer for Cape Town Marathon and WP Athletics.',
            ],
            [
                'email' => 'jordan@lens.co',
                'name' => 'Jordan Miller',
                'tier' => 'pro',
                'membership_id' => $proPlan?->id,
                'phone' => '+27 82 441 9082',
                'location' => 'Cape Town, South Africa',
                'specialty' => 'Rugby & School Athletics',
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=600&q=80',
                'bio' => 'Capturing high-intensity school sports and provincial tournament finals with sharp precision and dynamic sideline energy.',
                'verification_badge' => 'Pro Member VIP',
                'custom_storage_limit' => '1 TB',
                'custom_commission_rate' => '8%',
                'custom_features' => ['ai_search', 'custom_watermark', 'direct_messages', 'custom_domain', 'priority_support'],
                'payout_email' => 'jordan@lens.co',
                'payout_method' => 'Bank Transfer · FNB #4821',
                'admin_notes' => 'Custom VIP override granted: 8% commission and 1 TB storage.',
            ],
            [
                'email' => 'sarah@capture.co',
                'name' => 'Sarah Kim',
                'tier' => 'standard',
                'membership_id' => $standardPlan?->id,
                'phone' => '+27 72 118 6304',
                'location' => 'Johannesburg, South Africa',
                'specialty' => 'Football, Tennis & Swimming',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=600&q=80',
                'bio' => 'Johannesburg-based sports action shooter specializing in youth football championships, aquatic galas and tennis circuits.',
                'verification_badge' => 'Standard Member',
                'custom_features' => ['custom_watermark', 'direct_messages'],
                'payout_email' => 'sarah@capture.co',
                'payout_method' => 'Bank Transfer · Nedbank',
                'admin_notes' => 'Verified SA tournament shooter.',
            ],
            [
                'email' => 'michael@adamsphoto.co.za',
                'name' => 'Michael Adams',
                'tier' => 'starter',
                'membership_id' => $starterPlan?->id,
                'phone' => '+27 83 902 4411',
                'location' => 'Durban, South Africa',
                'specialty' => 'Ocean Sports & Trail Running',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80',
                'bio' => 'Ocean sports, trail running and coastal sporting community coverage across KwaZulu-Natal and Western Cape.',
                'verification_badge' => 'Starter Member',
                'custom_features' => ['direct_messages'],
                'payout_email' => 'michael@adamsphoto.co.za',
                'payout_method' => 'Bank Transfer · Capitec',
                'admin_notes' => 'Active coastal sports shooter.',
            ],
            [
                'email' => 'sipho@photoguild.co.za',
                'name' => 'Sipho Dlamini',
                'tier' => 'photoguild',
                'membership_id' => $guildPlan?->id,
                'phone' => '+27 71 889 0012',
                'location' => 'Durban & KZN, South Africa',
                'specialty' => 'Rugby 7s & Track Athletics',
                'avatar' => 'https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=600&q=90',
                'bio' => 'PhotoGuild SA Master Craftsman covering premier school derby days, Coastal Rugby 7s and regional athletic championships.',
                'verification_badge' => 'Photo Guild Member',
                'custom_commission_rate' => '5%',
                'custom_features' => ['ai_search', 'custom_watermark', 'direct_messages', 'priority_support'],
                'payout_email' => 'sipho@photoguild.co.za',
                'payout_method' => 'PhotoGuild Direct Payout',
                'admin_notes' => 'Official PhotoGuild SA partner member allocated private guild tier.',
            ],
            [
                'email' => 'daniel@stellenboschlens.co.za',
                'name' => 'Daniel Jacobs',
                'tier' => 'pro',
                'membership_id' => $proPlan?->id,
                'phone' => '+27 82 771 9920',
                'location' => 'Stellenbosch, South Africa',
                'specialty' => 'Varsity Rugby & Cycling',
                'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=600&q=88',
                'bio' => 'Match-day energy, honest reactions and the frame after the frame across Western Cape varsity sport and Winelands cycling.',
                'verification_badge' => 'Pro Member',
                'custom_features' => ['ai_search', 'custom_watermark', 'direct_messages', 'priority_support'],
                'payout_email' => 'daniel@stellenboschlens.co.za',
                'payout_method' => 'Bank Transfer · Investec',
                'admin_notes' => 'Stellenbosch university sports lead.',
            ],
        ];

        $allowedEmails = collect($photographersConfig)->pluck('email')->all();

        // Delete any photographer not in the 6
        User::where('role', 'photographer')->whereNotIn('email', $allowedEmails)->delete();

        // Create or update the 6 photographers
        $photographers = [];
        foreach ($photographersConfig as $cfg) {
            $user = User::updateOrCreate(
                ['email' => $cfg['email']],
                array_merge($cfg, [
                    'password' => Hash::make('password123'),
                    'role' => 'photographer',
                    'status' => 'active',
                    'is_verified' => true,
                ])
            );
            $photographers[$cfg['email']] = $user;
        }

        // 2. Clean up dummy/test events
        Event::where('title', 'like', '%test%')
            ->orWhere('title', 'like', '%new event check%')
            ->orWhere('slug', 'like', '%this-is-testing%')
            ->orWhere('slug', 'like', '%new-event-check%')
            ->delete();

        // 3. Define the 12 events (2 per photographer)
        $eventsConfig = [
            // Aiden Daniels (2 events: Running & Marathons)
            [
                'photographer_email' => 'aiden@photox.com',
                'title' => 'City Marathon 2026',
                'slug' => 'city-marathon-2026',
                'category_name' => 'Running',
                'location' => 'Cape Town, South Africa',
                'event_date' => '2026-09-14',
                'starting_price' => 'From R90',
                'description' => 'Cape Town annual city marathon capturing runners across the iconic Atlantic seaboard coastline.',
                'cover_image' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => true,
                'photos' => [
                    ['title' => 'Finish Line Breakthrough', 'file_path' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '1042'],
                    ['title' => 'Sprint Across the Line', 'file_path' => 'https://images.unsplash.com/photo-1502680390469-be75c86b636f?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '2319'],
                    ['title' => 'Runner Focus & Determination', 'file_path' => 'https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '4091'],
                    ['title' => 'Leading Pack Mountain Pass', 'file_path' => 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '1005'],
                    ['title' => 'Track Cadence & Power', 'file_path' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '3128'],
                    ['title' => 'Gold Medal Podium Honor', 'file_path' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '1001'],
                ],
            ],
            [
                'photographer_email' => 'aiden@photox.com',
                'title' => 'TrailFun Spring Series',
                'slug' => 'trailfun-spring-series',
                'category_name' => 'Running',
                'location' => 'Durbanville Hills, Cape Town',
                'event_date' => '2026-10-04',
                'starting_price' => 'From R85',
                'description' => 'Morning trail run across scenic vineyard single tracks and vineyard ridges.',
                'cover_image' => 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => false,
                'photos' => [
                    ['title' => 'Morning Ridge Ascent', 'file_path' => 'https://images.unsplash.com/photo-1486218119243-13883505764c?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '512'],
                    ['title' => 'Vineyard Trail Sprint', 'file_path' => 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '589'],
                    ['title' => 'Finishline Pure Joy', 'file_path' => 'https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '620'],
                    ['title' => 'Spring Crest Pace', 'file_path' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '441'],
                ],
            ],

            // Jordan Miller (2 events: School sport & Cape Town Marathon 2026)
            [
                'photographer_email' => 'jordan@lens.co',
                'title' => 'Varsity Clash 2026',
                'slug' => 'varsity-clash',
                'category_name' => 'School sport',
                'location' => 'Pretoria Sports Ground',
                'event_date' => '2026-09-18',
                'starting_price' => 'From R80',
                'description' => 'Inter-school sports derby featuring athletics, rugby sevens and hockey championship fixtures.',
                'cover_image' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => true,
                'photos' => [
                    ['title' => 'Derby Clash Breakthrough', 'file_path' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '12'],
                    ['title' => 'Sprint Along the Touchline', 'file_path' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '15'],
                    ['title' => 'Inter-School Victory Roar', 'file_path' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '7'],
                    ['title' => 'Goal Line Defense', 'file_path' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '21'],
                ],
            ],
            [
                'photographer_email' => 'jordan@lens.co',
                'title' => 'Cape Town Marathon 2026',
                'slug' => 'cape-town-marathon-2026',
                'category_name' => 'Running',
                'location' => 'Cape Town Stadium & Waterfront',
                'event_date' => '2026-09-28',
                'starting_price' => 'From R95',
                'description' => 'Africa’s premier World Marathon Major candidate event, capturing elite athletes and thousands of runners through the Mother City.',
                'cover_image' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => true,
                'photos' => [
                    ['title' => 'Elite Pack Seaward Road', 'file_path' => 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '001'],
                    ['title' => 'Green Point Stadium Turn', 'file_path' => 'https://images.unsplash.com/photo-1486218119243-13883505764c?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '189'],
                    ['title' => 'Marathon Finishline Embrace', 'file_path' => 'https://images.unsplash.com/photo-1502680390469-be75c86b636f?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '942'],
                    ['title' => 'Medal Showcase Waterfront', 'file_path' => 'https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '4120'],
                ],
            ],

            // Sarah Kim (2 events: Football & Swimming)
            [
                'photographer_email' => 'sarah@capture.co',
                'title' => 'National U18 Final Cup',
                'slug' => 'national-u18-final-cup',
                'category_name' => 'Football',
                'location' => 'Johannesburg Stadium',
                'event_date' => '2026-09-20',
                'starting_price' => 'From R75',
                'description' => 'Final championship clash of the national provincial youth soccer tournament.',
                'cover_image' => 'https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => true,
                'photos' => [
                    ['title' => 'Championship Trophy Moment', 'file_path' => 'https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '10'],
                    ['title' => 'Strikers Volley on Target', 'file_path' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '9'],
                    ['title' => 'Penalty Decider Dive', 'file_path' => 'https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '1'],
                    ['title' => 'Winning Squad Euphoria', 'file_path' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '11'],
                ],
            ],
            [
                'photographer_email' => 'sarah@capture.co',
                'title' => 'Open Water Championship',
                'slug' => 'open-water-championship',
                'category_name' => 'Swimming',
                'location' => 'Camps Bay, Cape Town',
                'event_date' => '2026-09-10',
                'starting_price' => 'From R70',
                'description' => 'Endurance ocean swim gala featuring national squad qualifiers and open sea category racers.',
                'cover_image' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => false,
                'photos' => [
                    ['title' => 'Ocean Swimmer Stroke', 'file_path' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '88'],
                    ['title' => 'Coastal Break Wave Entry', 'file_path' => 'https://images.unsplash.com/photo-1519315901367-f34ff9154487?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '92'],
                    ['title' => 'Atlantic Sprints Buoy Turn', 'file_path' => 'https://images.unsplash.com/photo-1502680390469-be75c86b636f?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '104'],
                ],
            ],

            // Michael Adams (2 events: Cycling & Coastal running)
            [
                'photographer_email' => 'michael@adamsphoto.co.za',
                'title' => 'Mountain Trail Classic',
                'slug' => 'mountain-trail-classic',
                'category_name' => 'Cycling',
                'location' => 'Franschhoek Valley Pass',
                'event_date' => '2026-09-22',
                'starting_price' => 'From R88',
                'description' => 'High-altitude mountain bike endurance ride navigating rocky ridges and technical single-tracks.',
                'cover_image' => 'https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => false,
                'photos' => [
                    ['title' => 'Rocky Crest Descent', 'file_path' => 'https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '301'],
                    ['title' => 'Pine Forest Single Track', 'file_path' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '342'],
                    ['title' => 'Valley Switchback Push', 'file_path' => 'https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '388'],
                ],
            ],
            [
                'photographer_email' => 'michael@adamsphoto.co.za',
                'title' => 'Coastal Cross Challenge',
                'slug' => 'coastal-cross-challenge',
                'category_name' => 'Running',
                'location' => 'Hermanus Cliff Path',
                'event_date' => '2026-09-25',
                'starting_price' => 'From R79',
                'description' => 'Spectacular seaside trail race overlooking Walker Bay with rugged ocean views.',
                'cover_image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => false,
                'photos' => [
                    ['title' => 'Cliff Top Sprint', 'file_path' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '711'],
                    ['title' => 'Ocean Breeze Stride', 'file_path' => 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '725'],
                    ['title' => 'Finishline Coastal Flare', 'file_path' => 'https://images.unsplash.com/photo-1502680390469-be75c86b636f?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '790'],
                ],
            ],

            // Sipho Dlamini (2 events: Coastal Rugby 7s & KZN Coastline Athletics)
            [
                'photographer_email' => 'sipho@photoguild.co.za',
                'title' => 'Coastal Rugby 7s',
                'slug' => 'coastal-rugby-7s',
                'category_name' => 'Rugby',
                'location' => 'Kings Park Stadium, Durban',
                'event_date' => '2026-09-15',
                'starting_price' => 'From R99',
                'description' => 'Fast-paced premier sevens rugby tournament showcasing national club and provincial squads.',
                'cover_image' => 'https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => true,
                'photos' => [
                    ['title' => 'Sevens Sidestep Blitz', 'file_path' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '7'],
                    ['title' => 'Corner Flag Dive Try', 'file_path' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '14'],
                    ['title' => 'High Tackle Evasion', 'file_path' => 'https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '11'],
                    ['title' => 'Cup Champions Toast', 'file_path' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '9'],
                ],
            ],
            [
                'photographer_email' => 'sipho@photoguild.co.za',
                'title' => 'KZN Ocean & Surf Athletics 2026',
                'slug' => 'kzn-ocean-surf-athletics-2026',
                'category_name' => 'Swimming',
                'location' => 'Durban Beachfront, KZN',
                'event_date' => '2026-10-02',
                'starting_price' => 'From R85',
                'description' => 'Lifesaving championships and beach sprints along Durban’s famed Golden Mile.',
                'cover_image' => 'https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => false,
                'photos' => [
                    ['title' => 'Beach Sprint Splash', 'file_path' => 'https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '54'],
                    ['title' => 'Surf Rescue Wave Catch', 'file_path' => 'https://images.unsplash.com/photo-1519315901367-f34ff9154487?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '62'],
                    ['title' => 'Golden Mile Sand Sprint', 'file_path' => 'https://images.unsplash.com/photo-1502680390469-be75c86b636f?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '78'],
                ],
            ],

            // Daniel Jacobs (2 events: Varsity Rugby & Cycling)
            [
                'photographer_email' => 'daniel@stellenboschlens.co.za',
                'title' => 'Maties vs Ikeys Varsity Cup',
                'slug' => 'maties-vs-ikeys-varsity-cup',
                'category_name' => 'Rugby',
                'location' => 'Danie Craven Stadium, Stellenbosch',
                'event_date' => '2026-09-12',
                'starting_price' => 'From R120',
                'description' => 'Legendary Varsity Cup rugby clash between historical rivals with sold-out grandstands and fierce physical play.',
                'cover_image' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => true,
                'photos' => [
                    ['title' => 'Match-Day Collision', 'file_path' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '4'],
                    ['title' => 'Stadium Electric Atmosphere', 'file_path' => 'https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '8'],
                    ['title' => 'Try-Line Drive', 'file_path' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '13'],
                    ['title' => 'Scrum Front Row Clash', 'file_path' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '3'],
                ],
            ],
            [
                'photographer_email' => 'daniel@stellenboschlens.co.za',
                'title' => 'Winelands Cycle Tour',
                'slug' => 'winelands-cycle-tour',
                'category_name' => 'Cycling',
                'location' => 'Paarl & Stellenbosch Wine Valleys',
                'event_date' => '2026-09-06',
                'starting_price' => 'From R95',
                'description' => 'Premier Western Cape open-road bicycle race through scenic wine valleys and mountain passes.',
                'cover_image' => 'https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=1200&q=85',
                'is_featured' => true,
                'photos' => [
                    ['title' => 'Peloton Mountain Ascent', 'file_path' => 'https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '201'],
                    ['title' => 'Road Race Decider', 'file_path' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '214'],
                    ['title' => 'Breakaway Sprint to the Line', 'file_path' => 'https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '230'],
                    ['title' => 'Vineyard Valley Stream', 'file_path' => 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&w=1400&q=90', 'bib_number' => '289'],
                ],
            ],
        ];

        // Ensure category mappings exist
        $categories = Category::all()->keyBy('name');

        foreach ($eventsConfig as $eData) {
            $photographer = $photographers[$eData['photographer_email']];
            $category = $categories[$eData['category_name']] ?? Category::firstOrCreate(['name' => $eData['category_name']], ['slug' => Str::slug($eData['category_name'])]);

            $event = Event::updateOrCreate(
                ['slug' => $eData['slug']],
                [
                    'title' => $eData['title'],
                    'photographer_id' => $photographer->id,
                    'photographer_name' => $photographer->name,
                    'category_id' => $category->id,
                    'category_name' => $category->name,
                    'location' => $eData['location'],
                    'event_date' => $eData['event_date'],
                    'starting_price' => $eData['starting_price'],
                    'description' => $eData['description'],
                    'cover_image' => $eData['cover_image'],
                    'is_featured' => $eData['is_featured'],
                    'status' => 'published',
                    'is_demo' => true,
                    'photographers_count' => 1,
                ]
            );

            // Seed photos for this event
            foreach ($eData['photos'] as $pData) {
                EventPhoto::updateOrCreate(
                    [
                        'event_id' => $event->id,
                        'title' => $pData['title'],
                    ],
                    [
                        'photographer_id' => $photographer->id,
                        'photographer_name' => $photographer->name,
                        'file_path' => $pData['file_path'],
                        'watermarked_path' => null,
                        'original_name' => Str::slug($pData['title']).'.jpg',
                        'bib_number' => $pData['bib_number'] ?? null,
                        'camera_make' => 'Sony',
                        'camera_model' => 'Alpha 1 Pro',
                        'lens' => 'FE 70-200mm f/2.8 GM OSS II',
                        'focal_length' => '135mm',
                        'shutter_speed' => '1/2000s',
                        'aperture' => 'f/2.8',
                        'iso' => '400',
                        'flash' => 'Off (Did not fire)',
                        'dimensions' => '6000 x 4000 px',
                        'file_size' => '14.2 MB',
                        'captured_at' => $event->event_date ? $event->event_date->format('Y-m-d 10:30:00') : now(),
                        'copyright' => '© 2026 '.$photographer->name.' / PhotoX',
                        'personal_price' => 75.00,
                        'commercial_price' => 350.00,
                        'is_demo' => true,
                    ]
                );
            }

            // Sync total_photos count
            $event->update([
                'total_photos' => $event->photos()->count(),
            ]);
        }

        // Delete any events not in our configured slugs
        $validSlugs = collect($eventsConfig)->pluck('slug')->all();
        Event::whereNotIn('slug', $validSlugs)->delete();

        // Delete orphaned photos
        EventPhoto::whereNotIn('event_id', Event::pluck('id'))->delete();
    }
}
