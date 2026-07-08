<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceMethod extends Model
{
    protected $fillable = [

        'service_setting_id',

        'title',

        'image_path',

        'url',

        'sort_order',

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

    public function serviceSetting()
    {
        return $this->belongsTo(
            ServiceSetting::class
        );
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