<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_photo_id',
        'reason',
        'details',
        'status',
        'ip_address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photo(): BelongsTo
    {
        return $this->belongsTo(EventPhoto::class, 'event_photo_id');
    }
}
