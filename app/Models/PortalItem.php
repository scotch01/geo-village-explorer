<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Desa;

class PortalItem extends Model
{
    protected $fillable = [

        'portal_category_id',

        'desa_id',

        'title',

        'description',

        'file_type',

        'url',

        'image_path',

        'sort_order',

        'is_active',

    ];

    public function category()
    {
        return $this->belongsTo(
            PortalCategory::class,
            'portal_category_id'
        );
    }

    public function scopeActive($query)
    {
        return $query->where(
            'is_active',
            true
        );
    }

    public function desa()
    {
        return $this->belongsTo(
            Desa::class
        );
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }

    public function getFileTypeLabelAttribute()
    {
        return match ($this->file_type) {

            'pdf'
                => 'PDF',

            'excel'
                => 'Excel',

            'spreadsheet'
                => 'Spreadsheet',

            'dashboard'
                => 'Dashboard',

            'website'
                => 'Website',

            default
                => 'Link',
        };
    }
}