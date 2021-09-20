<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    protected $fillable = [
        'active',
        'user_id',
        'categorie_id',
        'age',
        'name',
        'cover_path',
        'description',
        'date_event',
        'paide_id',
        'price',
        'number_volume',
        'number_available',
        'countrie_id',
        'citie_id',
        'location',
        'tags',
        'reviewed',
    ];

    use HasFactory;
}
