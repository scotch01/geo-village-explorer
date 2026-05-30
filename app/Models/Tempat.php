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

    public function usaha()
    {
        return $this->hasOne(Usaha::class);
    }

    public function anggotaKeluargas()
    {
        return $this->hasManyThrough(
            AnggotaKeluarga::class,
            Keluarga::class
        );
    }

    public function getStatusPendataanAttribute()
    {
        if ($this->jenis_bangunan === 'btt') {

            return $this->keluarga
                ? 'selesai'
                : 'belum';
        }

        if ($this->jenis_bangunan === 'bku') {

            return $this->usaha
                ? 'selesai'
                : 'belum';
        }

        if ($this->jenis_bangunan === 'bc') {

            if ($this->keluarga && $this->usaha) {
                return 'selesai';
            }

            return 'parsial';
        }

        return 'belum';
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

    public function getUsahaCompletedAttribute()
    {
        return $this->usaha !== null;
    }
}