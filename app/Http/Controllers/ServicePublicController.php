<?php

namespace App\Http\Controllers;

use App\Models\ServiceSetting;
use App\Models\Desa;

class ServicePublicController extends Controller
{
    public function index()
    {
        $services = ServiceSetting::query()
            ->active()
            ->with([
                'desa',

                'methods' => function ($query) {

                    $query->where(
                            'is_active',
                            true
                        )
                        ->orderBy(
                            'sort_order'
                        );

                },

            ])
            ->orderBy(
                Desa::select('nama_desa')
                    ->whereColumn(
                        'desas.id',
                        'service_settings.desa_id'
                    )
            )
            ->get();

        return view(
            'public.service',
            [
                'services' => $services,
            ]
        );
    }
}
