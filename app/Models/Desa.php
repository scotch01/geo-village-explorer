<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $fillable = [
        'nama_desa',
        'kode_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
    ];

    /**
     * Users
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_desa');
    }

    /**
     * Tempats
     */
    public function tempats()
    {
        return $this->hasMany(Tempat::class, 'id_desa');
    }
}