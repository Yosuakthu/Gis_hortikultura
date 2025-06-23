<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoData extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanaman',
        'lokasi',
        'luas',
        'elevasi',
        'no_hp',
        'kelompok',
        'leader',
        'no_leader',
        'al_leader',
        'komoditi',
        'varietas',
        'jumb_bibit',
        'images',
        'geojson_path'

    ];

       protected $casts = [
        'images' => 'array',
    ];
}
