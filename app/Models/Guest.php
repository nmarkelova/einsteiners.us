<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'active',
        'name',
        'user_id',
        'event_id',
        'role',
        'task',
        'email',
        'send',
    ];

    use HasFactory;
}
