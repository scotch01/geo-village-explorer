<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $guarded = [];

    protected $casts = [
        'kredit_sumber' => 'array',
        'kredit_tujuan' => 'array',
    ];

    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }

    public function anggotaKeluargas()
    {
        return $this->hasMany(
            AnggotaKeluarga::class
        );
    }

    public function meterans()
    {
        return $this->hasMany(
            KeluargaMeteran::class
        );
    }
}