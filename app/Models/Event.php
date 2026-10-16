<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'photographer_id',
        'photographer_name',
        'category_id',
        'category_name',
        'location',
        'event_date',
        'starting_price',
        'allow_individual_sales',
        'full_gallery_price',
        'total_photos',
        'photographers_count',
        'description',
        'cover_image',
        'cover_photo_id',
        'is_featured',
        'status',
        'is_demo',
    ];

    protected $casts = [
        'event_date' => 'date',
        'allow_individual_sales' => 'boolean',
        'full_gallery_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_demo' => 'boolean',
        'total_photos' => 'integer',
        'photographers_count' => 'integer',
    ];

    public function photographer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(EventPhoto::class);
    }

    public function coverPhoto(): BelongsTo
    {
        return $this->belongsTo(EventPhoto::class, 'cover_photo_id');
    }

    public function getStartingPriceAttribute($value): string
    {
        $val = trim((string) $value);
        if ($val === '') {
            return 'From R50';
        }
        if (str_starts_with($val, 'From R') || str_starts_with($val, 'From R ') || str_starts_with($val, 'R')) {
            return $val;
        }
        return 'From R' . $val;
    }
}
