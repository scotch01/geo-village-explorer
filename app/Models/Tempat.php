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
     * Jenis Bangunan
     */

    public const JENIS_BTT = 'btt';

    public const JENIS_BKU = 'bku';

    public const JENIS_BC = 'bc';

    public const JENIS_BANGUNAN = [
        self::JENIS_BTT => 'Bangunan Tempat Tinggal',
        self::JENIS_BKU => 'Bangunan Khusus Usaha',
        self::JENIS_BC  => 'Bangunan Campuran',
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
}