<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\PortalItem;

class PortalCategory extends Model
{
    protected $fillable = [

        'type',

        'name',

        'slug',

        'sort_order',

        'is_active',

    ];

    protected static function booted()
    {
        static::creating(function ($category) {

            $category->slug =
                Str::slug(
                    $category->name
                );

        });

        static::updating(function ($category) {

            $category->slug =
                Str::slug(
                    $category->name
                );

        });
    }

    public function items()
    {
        return $this->hasMany(
            PortalItem::class
        );
    }

    public function scopeActive($query)
    {
        return $query->where(
            'is_active',
            true
        );
    }
}