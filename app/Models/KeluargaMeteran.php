<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeluargaMeteran extends Model
{
    protected $guarded = [];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }
}