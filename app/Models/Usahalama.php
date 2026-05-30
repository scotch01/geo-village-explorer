<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $fillable = [
        'nama_usaha',
        'kategori_usaha',
        'nama_pemilik',
        'alamat',
        'no_hp',
        'deskripsi',
        'latitude',
        'longitude',
        'is_active',
    ];

    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
        'is_active' => 'boolean',
    ];
}
