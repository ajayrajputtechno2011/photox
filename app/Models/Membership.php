<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'badge',
        'tagline',
        'monthly_price',
        'yearly_price',
        'currency',
        'price_display',
        'commission_rate',
        'storage_limit',
        'features_included_title',
        'features',
        'is_featured',
        'theme_style',
        'button_text',
        'button_url',
        'subscribers_count',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'subscribers_count' => 'integer',
        'sort_order' => 'integer',
    ];
}
