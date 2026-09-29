<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WatermarkSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WatermarkController extends Controller
{
    /**
     * Display the Watermark Studio configuration screen.
     */
    public function index(): View
    {
        $setting = WatermarkSetting::firstOrCreate(
            ['user_id' => null],
            [
                'is_watermark_enabled' => true,
                'watermark_type' => 'logo',
                'watermark_text' => '@pawan_123',
                'font_size' => 25,
                'opacity' => 65,
                'rotation' => -12,
                'is_tiled' => true,
                'logo_path' => '/logo.png',
                'logo_size' => 45,
                'both_layout' => 'stacked',
                'both_gap' => 8,
                'is_download_protection_enabled' => true,
                'is_motion_mask_enabled' => false,
            ]
        );

        return view('admin.watermarks', compact('setting'));
    }

    /**
     * Save / update watermark & digital rights settings.
     */
    public function save(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'is_watermark_enabled' => 'nullable|boolean',
            'watermark_type' => 'required|in:text,logo,both',
            'watermark_text' => 'nullable|string|max:80',
            'font_size' => 'nullable|integer|min:10|max:100',
            'opacity' => 'nullable|integer|min:5|max:100',
            'rotation' => 'nullable|integer|min:-90|max:90',
            'is_tiled' => 'nullable|boolean',
            'logo_size' => 'nullable|integer|min:15|max:200',
            'both_layout' => 'nullable|in:stacked,inline,alternating,fotto_style',
            'both_gap' => 'nullable|integer|min:0|max:50',
            'watermark_color' => 'nullable|string|max:30',
            'security_badge_text' => 'nullable|string|max:100',
            'has_cross_lines' => 'nullable|boolean',
            'has_security_badge' => 'nullable|boolean',
            'is_download_protection_enabled' => 'nullable|boolean',
            'is_motion_mask_enabled' => 'nullable|boolean',
            'watermark_pattern' => 'nullable|in:fotto_pro,photox_pro,tiled,single_large,double_cross,hex_mesh,quad_corners',
            'watermark_density' => 'nullable|in:medium,high,ultra',
            'has_anti_ai_lines' => 'nullable|boolean',
            'single_logo_size' => 'nullable|integer|min:40|max:1000',
            'is_post_purchase_enabled' => 'nullable|boolean',
            'post_purchase_mode' => 'nullable|in:clean,sponsor_branded',
            'sponsor_placement' => 'nullable|in:bottom_right,bottom_left,top_right,top_left,middle_bottom',
            'sponsor_logo_size' => 'nullable|integer|min:20|max:200',
            'sponsor_opacity' => 'nullable|integer|min:10|max:100',
            'sponsor_margin' => 'nullable|integer|min:0|max:100',
            'logo' => 'nullable|image|mimes:png,svg,webp|max:4096',
            'sponsor_logo' => 'nullable|image|mimes:png,svg,webp,jpg,jpeg|max:4096',
        ]);

        $setting = WatermarkSetting::firstOrCreate(['user_id' => null]);

        $data = [
            'is_watermark_enabled' => $request->boolean('is_watermark_enabled', true),
            'watermark_type' => $validated['watermark_type'],
            'watermark_text' => $validated['watermark_text'] ?? '@pawan_123',
            'font_size' => (int) ($validated['font_size'] ?? 25),
            'opacity' => (int) ($validated['opacity'] ?? 65),
            'rotation' => (int) ($validated['rotation'] ?? -12),
            'is_tiled' => $request->boolean('is_tiled', true),
            'watermark_pattern' => $validated['watermark_pattern'] ?? 'fotto_pro',
            'watermark_density' => $validated['watermark_density'] ?? 'high',
            'has_anti_ai_lines' => $request->boolean('has_anti_ai_lines', true),
            'single_logo_size' => (int) ($validated['single_logo_size'] ?? 160),
            'logo_size' => (int) ($validated['logo_size'] ?? 45),
            'both_layout' => $validated['both_layout'] ?? 'stacked',
            'both_gap' => (int) ($validated['both_gap'] ?? 8),
            'watermark_color' => $validated['watermark_color'] ?? 'orange',
            'security_badge_text' => $validated['security_badge_text'] ?? 'Do not screenshot',
            'has_cross_lines' => $request->boolean('has_cross_lines', true),
            'has_security_badge' => $request->boolean('has_security_badge', true),
            'is_download_protection_enabled' => $request->boolean('is_download_protection_enabled', true),
            'is_motion_mask_enabled' => $request->boolean('is_motion_mask_enabled', false),
            'is_post_purchase_enabled' => $request->boolean('is_post_purchase_enabled', true),
            'post_purchase_mode' => $validated['post_purchase_mode'] ?? 'clean',
            'sponsor_placement' => $validated['sponsor_placement'] ?? 'bottom_right',
            'sponsor_logo_size' => (int) ($validated['sponsor_logo_size'] ?? 70),
            'sponsor_opacity' => (int) ($validated['sponsor_opacity'] ?? 90),
            'sponsor_margin' => (int) ($validated['sponsor_margin'] ?? 0),
        ];

        $destinationPath = public_path('uploads/watermarks');
        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        if ($request->hasFile('logo')) {
            $filename = 'logo_'.time().'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move($destinationPath, $filename);
            $data['logo_path'] = '/uploads/watermarks/'.$filename;
        }

        if ($request->hasFile('sponsor_logo')) {
            $filename = 'sponsor_'.time().'.'.$request->file('sponsor_logo')->getClientOriginalExtension();
            $request->file('sponsor_logo')->move($destinationPath, $filename);
            $data['sponsor_logo_path'] = '/uploads/watermarks/'.$filename;
        }

        $setting->update($data);

        // Invalidate existing cached watermarked images so web immediately reflects changes
        $wmDir = storage_path('app/public/uploads/demo/watermarked');
        if (is_dir($wmDir)) {
            $existingPreviews = glob($wmDir.'/*_wm.jpg');
            foreach ($existingPreviews as $previewFile) {
                @unlink($previewFile);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Watermark and digital protection settings saved successfully!',
            'setting' => $setting->fresh(),
        ]);
    }
}
