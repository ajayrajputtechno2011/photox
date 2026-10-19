<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the settings management view.
     */
    public function index(): View
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update all platform and API settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $groups = [
            'payment' => [
                'yoco_mode',
                'yoco_public_key',
                'yoco_secret_key',
                'yoco_webhook_secret',
                'currency_code',
                'currency_symbol',
            ],
            'storage' => [
                'storage_driver',
                'r2_account_id',
                'r2_access_key_id',
                'r2_secret_access_key',
                'r2_bucket',
                'r2_endpoint',
                'r2_public_domain',
            ],
            'commercial' => [
                'default_commission_rate',
                'default_gallery_price',
                'default_selfie_bundle_price',
                'default_single_photo_price',
                'commercial_license_surcharge',
                'min_payout_amount',
            ],
            'contact' => [
                'site_name',
                'contact_email',
                'contact_phone',
                'contact_address',
                'support_hours',
                'instagram_url',
                'facebook_url',
                'linkedin_url',
            ],
            'mail' => [
                'mail_mailer',
                'mail_host',
                'mail_port',
                'mail_username',
                'mail_password',
                'mail_encryption',
                'mail_from_address',
                'mail_from_name',
            ],
            'security' => [
                'maintenance_mode',
                'enable_watermark_protection',
                'enable_ai_search',
            ],
        ];

        foreach ($groups as $group => $keys) {
            foreach ($keys as $key) {
                // Check if it's a checkbox / boolean that may not be sent if unchecked
                if (in_array($key, ['maintenance_mode', 'enable_watermark_protection', 'enable_ai_search'])) {
                    $val = $request->has($key) ? '1' : '0';
                    Setting::set($key, $val, $group, 'boolean');
                } elseif ($request->has($key)) {
                    $val = (string) $request->input($key);
                    // Don't overwrite secret passwords with empty if user left it blank
                    if (in_array($key, ['yoco_secret_key', 'r2_secret_access_key', 'mail_password']) && empty(trim($val))) {
                        continue;
                    }
                    Setting::set($key, $val, $group);
                }
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Platform & API Settings successfully updated!');
    }
}
