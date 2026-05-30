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

    /**
     * Status Kepemilikan Rumah
     */

    public const STATUS_KEPEMILIKAN_RUMAH = [
        1 => 'Milik Sendiri',
        2 => 'Kontrak/Sewa',
        3 => 'Bebas Sewa',
        4 => 'Dinas',
        5 => 'Lainnya',
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