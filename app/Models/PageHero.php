<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageHero extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_key',
        'page_name',
        'kicker',
        'title',
        'description',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'image_url',
        'badge_text',
        'extra_data',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];
}
