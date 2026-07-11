<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BangunanLainnya extends Model
{
    protected $fillable = [

        'tempat_id',

        'nama_infrastruktur',

        'kategori',

        'alamat',

        'email',

        'website',

        'latitude',

        'longitude',

        'akurasi',

        'provinsi',

        'kabupaten',

        'kecamatan',

        'desa',

        'dusun',

    ];

    /**
     * Relasi ke Tempat
     */
    public function tempat()
    {
        return $this->belongsTo(
            Tempat::class
        );
    }
}