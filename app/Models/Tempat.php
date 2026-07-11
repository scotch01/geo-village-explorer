<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    protected $fillable = [
        'nama_tempat',
        'jenis_bangunan',

        'alamat',

        'latitude',
        'longitude',

        'foto_bangunan',
        'catatan',

        'id_desa',
        'created_by',

        'is_active',
    ];

    /**
     * Relations
     */

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function keluarga()
    {
        return $this->hasOne(Keluarga::class);
    }

    public function usahas()
    {
        return $this->hasMany(Usaha::class);
    }

    public function bangunanLainnya()
    {
        return $this->hasOne(
            BangunanLainnya::class
        );
    }

    public function anggotaKeluargas()
    {
        return $this->hasManyThrough(
            AnggotaKeluarga::class,
            Keluarga::class,
            'tempat_id',
            'keluarga_id'
        );
    }

    public function getKeluargaCompletedAttribute()
    {
        return $this->keluarga !== null;
    }

    public function getAnggotaCompletedAttribute()
    {
        return $this->anggotaKeluargas()
            ->exists();
    }

}