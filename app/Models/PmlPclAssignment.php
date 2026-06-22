<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmlPclAssignment extends Model
{
    protected $guarded = [];

    public function pml()
    {
        return $this->belongsTo(
            User::class,
            'pml_id'
        );
    }

    public function pcl()
    {
        return $this->belongsTo(
            User::class,
            'pcl_id'
        );
    }
}