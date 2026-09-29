<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatermarkSetting extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_watermark_enabled' => 'boolean',
        'is_tiled' => 'boolean',
        'is_download_protection_enabled' => 'boolean',
        'is_motion_mask_enabled' => 'boolean',
        'font_size' => 'integer',
        'opacity' => 'integer',
        'rotation' => 'integer',
        'logo_size' => 'integer',
        'both_gap' => 'integer',
        'has_cross_lines' => 'boolean',
        'has_security_badge' => 'boolean',
        'single_logo_size' => 'integer',
        'is_post_purchase_enabled' => 'boolean',
        'sponsor_logo_size' => 'integer',
        'sponsor_opacity' => 'integer',
        'sponsor_margin' => 'integer',
        'has_anti_ai_lines' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
