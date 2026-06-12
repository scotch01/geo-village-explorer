<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Tempat;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /**
         * BASE QUERY
         */
        $tempatQuery = Tempat::query();

        /**
         * RBAC
         */
        if ($user->isAdminDesa()) {

            $tempatQuery->where(
                'id_desa',
                $user->id_desa
            );
        }

        /**
         * DISTRIBUSI JENIS BANGUNAN
         */
        $chartJenisBangunan = (clone $tempatQuery)
            ->selectRaw(
                'jenis_bangunan,
                COUNT(*) as total'
            )
            ->groupBy('jenis_bangunan')
            ->get()
            ->map(function ($item) {

                return [

                    'short' => match ($item->jenis_bangunan) {

                        'btt' => 'BTT',
                        'bku' => 'BKU',
                        'bc'  => 'BC',

                        default => '-',
                    },

                    'label' => match ($item->jenis_bangunan) {

                        'btt'
                            => 'Bangunan Tempat Tinggal',

                        'bku'
                            => 'Bangunan Khusus Usaha',

                        'bc'
                            => 'Bangunan Campuran',

                        default => '-',
                    },

                    'total' => (int) $item->total,
                ];
            });

        /**
         * TOP DESA
         */
        $topDesa = Tempat::query()
            ->with([
                'desa:id,nama_desa'
            ])
            ->selectRaw(
                'id_desa,
                COUNT(*) as total'
            )
            ->groupBy('id_desa')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        /**
         * RECENT ACTIVITY
         */
        $recentTempats = (clone $tempatQuery)
            ->select([
                'id',
                'jenis_bangunan',
                'id_desa',
                'created_by',
                'created_at'
            ])
            ->with([
                'desa:id,nama_desa',
                'creator:id,name'
            ])
            ->latest()
            ->limit(5)
            ->get();

        /**
         * MAP PREVIEW
         */
        $mapData = (clone $tempatQuery)
            ->select([
                'id',
                'nama_tempat',
                'latitude',
                'longitude'
            ])
            ->get();

        return view('admin.dashboard', compact(
            'chartJenisBangunan',
            'topDesa',
            'recentTempats',
            'mapData'
        ));
    }
}