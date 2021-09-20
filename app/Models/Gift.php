<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        'active',
        'name',
        'user_id',
        'event_id',
        'cover_path',
        'description',
        'link_market',
    ];

    use HasFactory;
}
