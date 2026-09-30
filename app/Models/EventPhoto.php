<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'file_path',
        'watermarked_path',
        'original_name',
        'title',
        'bib_number',
        'sub_album',
        'camera_make',
        'camera_model',
        'lens',
        'focal_length',
        'shutter_speed',
        'aperture',
        'iso',
        'flash',
        'dimensions',
        'file_size',
        'captured_at',
        'photographer_name',
        'copyright',
        'personal_price',
        'commercial_price',
        'is_demo',
    ];

    protected $casts = [
        'captured_at' => 'datetime',
        'personal_price' => 'decimal:2',
        'commercial_price' => 'decimal:2',
        'is_demo' => 'boolean',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
