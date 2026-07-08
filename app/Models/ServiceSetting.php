<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSetting extends Model
{
    protected $fillable = [

        'desa_id',

        'maklumat_image',

        'whatsapp',

        'email',

        'sop_url',

        'is_active',

    ];

    protected $casts = [

        'is_active' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function desa()
    {
        return $this->belongsTo(
            Desa::class
        );
    }

    public function methods()
    {
        return $this->hasMany(
            ServiceMethod::class
        )->orderBy('sort_order');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where(
            'is_active',
            true
        );
    }
}