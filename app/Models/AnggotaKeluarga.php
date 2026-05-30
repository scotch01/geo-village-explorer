<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    protected $guarded = [];

    protected $casts = [
        'disabilitas' => 'array',
        'penyakit_kronis' => 'array',
        'jaminan_kesehatan' => 'array',
    ];

    /**
     * Hubungan Keluarga
     */

    public const HUBUNGAN_KELUARGA = [

        1 => 'Kepala Keluarga',
        2 => 'Istri / Suami',

        3 => 'Anak',

        4 => 'Menantu',

        5 => 'Cucu',

        6 => 'Orang Tua',

        7 => 'Mertua',

        8 => 'Famili Lain',

        9 => 'Lainnya',
    ];

    /**
     * Jenis Kelamin
     */

    public const JENIS_KELAMIN = [

        1 => 'Laki-Laki',
        2 => 'Perempuan',
    ];

    public function keluarga()
    {
        return $this->belongsTo(
            Keluarga::class
        );
    }

    public function profesi()
    {
        return $this->belongsTo(
            MasterProfesi::class,
            'master_profesi_id'
        );
    }
}