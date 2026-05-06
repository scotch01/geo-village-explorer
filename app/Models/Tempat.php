<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    /**
     * SEKTOR
     */
    const SEKTOR = [
        'ekonomi' => 'Ekonomi',
        'pendidikan' => 'Pendidikan',
        'kesehatan' => 'Kesehatan',
        'perumahan' => 'Perumahan',
        'pemerintahan' => 'Pemerintahan',
    ];

    protected $fillable = [
        'nama_tempat',
        'sektor',
        'metadata',
        'nama_pemilik',
        'alamat',
        'no_hp',
        'deskripsi',
        'latitude',
        'longitude',
        'id_desa',
        'created_by',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'is_active' => 'boolean',
        'metadata' => 'array',
    ];

    /**
     * Label sektor
     */
    public static function sektorLabel($value)
    {
        return self::SEKTOR[$value] ?? $value;
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}