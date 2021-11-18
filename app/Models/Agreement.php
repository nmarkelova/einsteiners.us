<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $fillable = [
        'name',
        'cover_path',
    ];
    
    use HasFactory;
}
