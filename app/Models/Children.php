<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $fillable = [
        'name',
        'birthday',
        'user_id',
    ];

    use HasFactory;
}
