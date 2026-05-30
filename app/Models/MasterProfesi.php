<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterProfesi extends Model
{
    protected $guarded = [];

    public function anggotaKeluargas()
    {
        return $this->hasMany(
            AnggotaKeluarga::class,
            'master_profesi_id'
        );
    }
}