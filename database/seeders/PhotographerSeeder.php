<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PhotographerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proPlan = Membership::where('slug', 'pro')->first();
        $starterPlan = Membership::where('slug', 'starter')->first();
        $standardPlan = Membership::where('slug', 'standard')->first();
        $guildPlan = Membership::where('slug', 'photoguild')->first();

        // 1. Aiden Daniels (Pro Member - Sports documentary)
        User::updateOrCreate(
            ['email' => 'aiden@photox.com'],
            [
                'name' => 'Aiden Daniels',
                'password' => Hash::make('password123'),
                'role' => 'photographer',
                'status' => 'active',
                'is_verified' => true,
                'tier' => 'pro',
                'membership_id' => $proPlan?->id,
                'phone' => '+27 21 555 0192',
                'location' => 'Cape Town, South Africa',
                'specialty' => 'Running, Rugby & Cycling',
                'avatar' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=600&q=90',
                'bio' => 'Documentary sports photography for the split second, the quiet build-up and everything that happens after the finish line. Based in Cape Town, covering marathons, rugby, track & cycling.',
                'verification_badge' => 'Pro Member',
                'custom_features' => ['ai_search', 'custom_watermark', 'direct_messages', 'priority_support'],
                'payout_email' => 'payouts@aidendaniels.co.za',
                'payout_method' => 'Bank Transfer · Standard Bank (SA)',
                'admin_notes' => 'Accredited sports documentary photographer for Cape Town Marathon and WP Rugby.',
            ]
        );

        // 2. Jordan Miller (Pro Studio with Custom Override: 1 TB storage, 8% commission)
        User::updateOrCreate(
            ['email' => 'jordan@lens.co'],
            [
                'name' => 'Jordan Miller',
                'password' => Hash::make('password123'),
                'role' => 'photographer',
                'status' => 'active',
                'is_verified' => true,
                'tier' => 'pro',
                'membership_id' => $proPlan?->id,
                'phone' => '+27 82 441 9082',
                'location' => 'Cape Town, South Africa',
                'specialty' => 'Rugby & School Athletics',
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=300&q=80',
                'bio' => 'Capturing high-intensity school sports and provincial tournament finals with sharp precision.',
                'verification_badge' => 'Pro Member',
                'custom_storage_limit' => '1 TB',
                'custom_commission_rate' => '8%',
                'custom_features' => ['ai_search', 'custom_watermark', 'direct_messages', 'custom_domain', 'priority_support'],
                'payout_email' => 'jordan@lens.co',
                'payout_method' => 'Bank Transfer · FNB #4821',
                'admin_notes' => 'Custom VIP override granted: 8% commission and 1 TB storage.',
            ]
        );

        // 3. Sarah Kim (Standard Member - Tennis & Aquatic)
        User::updateOrCreate(
            ['email' => 'sarah@capture.co'],
            [
                'name' => 'Sarah Kim',
                'password' => Hash::make('password123'),
                'role' => 'photographer',
                'status' => 'active',
                'is_verified' => true,
                'tier' => 'standard',
                'membership_id' => $standardPlan?->id,
                'phone' => '+27 72 118 6304',
                'location' => 'Johannesburg, South Africa',
                'specialty' => 'Tennis, Hockey & Swimming',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80',
                'bio' => 'Johannesburg-based sports action shooter specializing in aquatic and court sports.',
                'verification_badge' => 'Standard Member',
                'custom_features' => ['custom_watermark', 'direct_messages'],
                'payout_email' => 'sarah@capture.co',
                'payout_method' => 'Bank Transfer · Nedbank',
                'admin_notes' => 'Verified SA tennis club shooter.',
            ]
        );

        // 4. Michael Adams (Starter Member)
        User::updateOrCreate(
            ['email' => 'michael@adamsphoto.co.za'],
            [
                'name' => 'Michael Adams',
                'password' => Hash::make('password123'),
                'role' => 'photographer',
                'status' => 'active',
                'is_verified' => true,
                'tier' => 'starter',
                'membership_id' => $starterPlan?->id,
                'phone' => '+27 83 902 4411',
                'location' => 'Durban, South Africa',
                'specialty' => 'Surfing & Ocean Events',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
                'bio' => 'Ocean sports, trail running and Durban beachfront sporting community.',
                'verification_badge' => 'Starter Member',
                'payout_email' => 'michael@adamsphoto.co.za',
                'payout_method' => 'Bank Transfer · Capitec',
                'admin_notes' => 'Trial period starter account.',
            ]
        );

        // 5. Sipho Dlamini (PhotoGuild SA Member - Private Guild Tier with 5% Commission)
        User::updateOrCreate(
            ['email' => 'sipho@photoguild.co.za'],
            [
                'name' => 'Sipho Dlamini',
                'password' => Hash::make('password123'),
                'role' => 'photographer',
                'status' => 'active',
                'is_verified' => true,
                'tier' => 'photoguild',
                'membership_id' => $guildPlan?->id,
                'phone' => '+27 71 889 0012',
                'location' => 'Durban & KZN, South Africa',
                'specialty' => 'Rugby & Track Athletics',
                'avatar' => 'https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=300&q=90',
                'bio' => 'PhotoGuild SA Master Craftsman covering premier school derby days and regional athletic championships.',
                'verification_badge' => 'Photo Guild Member',
                'custom_commission_rate' => '5%',
                'custom_features' => ['ai_search', 'custom_watermark', 'direct_messages', 'priority_support'],
                'payout_email' => 'sipho@photoguild.co.za',
                'payout_method' => 'PhotoGuild Direct Payout',
                'admin_notes' => 'Official PhotoGuild SA partner member allocated hidden guild tier.',
            ]
        );

        // 6. Daniel Jacobs (Rugby & Match-Day)
        User::updateOrCreate(
            ['email' => 'daniel@stellenboschlens.co.za'],
            [
                'name' => 'Daniel Jacobs',
                'password' => Hash::make('password123'),
                'role' => 'photographer',
                'status' => 'active',
                'is_verified' => true,
                'tier' => 'pro',
                'membership_id' => $proPlan?->id,
                'phone' => '+27 82 771 9920',
                'location' => 'Stellenbosch, South Africa',
                'specialty' => 'Events & Rugby',
                'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=300&q=88',
                'bio' => 'Match-day energy, honest reactions and the frame after the frame across Western Cape.',
                'verification_badge' => 'Pro Member',
                'payout_email' => 'daniel@stellenboschlens.co.za',
                'payout_method' => 'Bank Transfer · Investec',
                'admin_notes' => 'Stellenbosch university sports lead.',
            ]
        );

        // 7. Thandi Mokoena (Pending Approval - Verification Pending)
        User::updateOrCreate(
            ['email' => 'thandi@mokoenaphoto.co.za'],
            [
                'name' => 'Thandi Mokoena',
                'password' => Hash::make('password123'),
                'role' => 'photographer',
                'status' => 'pending_approval',
                'is_verified' => false,
                'tier' => 'standard',
                'membership_id' => $standardPlan?->id,
                'phone' => '+27 73 400 1289',
                'location' => 'Cape Town, South Africa',
                'specialty' => 'Athletics & Portraits',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=90',
                'bio' => 'Warm light and the real people inside every big South African sporting event.',
                'verification_badge' => 'Standard Member',
                'admin_notes' => 'ID document uploaded, awaiting admin verification check.',
            ]
        );
    }
}
