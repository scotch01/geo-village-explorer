<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortalCategory;

class PortalPublicController extends Controller
{
    public function publication()
    {
        $categories = PortalCategory::query()
            ->active()
            ->with([
                'items' => function ($query) {
                    $query->active()
                        ->with('desa')
                        ->orderBy('sort_order');
                }
            ])
            ->whereHas('items', function ($query) {
                $query->active();
            })
            ->orderBy('sort_order')
            ->get();

        return view(
            'public.publication',
            compact('categories')
        );
    }
}
