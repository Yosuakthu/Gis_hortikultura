<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoData extends Model
{
    use HasFactory;

    protected $fillable = [
        'fid_garisp',
        'fid_zona_l',
        'objectid',
        'jenis_zona',
        'shape_leng',
        'shape_area',
        'pstddev',
        'stddev',
        'mean',
        'count',
        'min',
        'max',
        'nozone',
        'rpbulat',
        'sum_nilai',
        'range_nila',
        'rpbulat_1',
        'sum_nilai1',
        'range_ni_1',
        'rp_1',
        'rp_2',
        'geometry',
    ];
}
