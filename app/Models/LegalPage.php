<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'content',
        'last_updated',
        'is_active',
    ];
}
