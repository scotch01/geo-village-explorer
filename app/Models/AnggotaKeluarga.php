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