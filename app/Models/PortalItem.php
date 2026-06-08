<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortalItem extends Model
{
    protected $fillable = [

        'portal_category_id',

        'title',

        'description',

        'file_type',

        'url',

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