<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $guarded = [];

    protected $casts = [

        'izin_usaha' => 'array',

        'penggunaan_internet' => 'array',

        'media_internet' => 'array',

        'alasan_tidak_internet' => 'array',

        'sumber_pinjaman' => 'array',

        'tujuan_pinjaman' => 'array',

        'tidak_menerima_kredit' => 'integer',

        'kendala_usaha' => 'array',
    ];

    public function tempat()
    {
        return $this->belongsTo(
            Tempat::class
        );
    }

    public function getUmurPemilikAttribute()
    {
        if (!$this->tanggal_lahir_pemilik) {
            return null;
        }

        return \Carbon\Carbon::parse(
            $this->tanggal_lahir_pemilik
        )->age;
    }
}