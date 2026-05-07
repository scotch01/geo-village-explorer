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
         * ADMIN DESA:
         * hanya data desanya sendiri
         */
        if ($user->isAdminDesa()) {

            $tempatQuery->where(
                'id_desa',
                $user->id_desa
            );
        }

        /**
         * TOTAL TEMPAT
         */
        $totalTempat = (clone $tempatQuery)->count();

        /**
         * TOTAL DESA
         */
        $totalDesa = $user->isMasterAdmin()
            ? Desa::count()
            : 1;

        /**
         * TOTAL USER
         */
        $totalUser = $user->isMasterAdmin()
            ? User::count()
            : 1;

        /**
         * TOTAL SEKTOR
         */
        $totalSektor = (clone $tempatQuery)
            ->distinct('sektor')
            ->count('sektor');

        /**
         * CHART SEKTOR
         */
        $chartSektor = (clone $tempatQuery)
            ->selectRaw('sektor, COUNT(*) as total')
            ->groupBy('sektor')
            ->orderByDesc('total')
            ->get();

        /**
         * TOP DESA
         */
        $topDesa = Tempat::query()
            ->with('desa')
            ->selectRaw('id_desa, COUNT(*) as total')
            ->groupBy('id_desa')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        /**
         * RECENT TEMPAT
         */
        $recentTempats = (clone $tempatQuery)
            ->with(['desa', 'creator'])
            ->latest()
            ->limit(5)
            ->get();

        /**
         * MAP DATA
         */
        $mapData = (clone $tempatQuery)
            ->select([
                'id',
                'nama_tempat',
                'sektor',
                'latitude',
                'longitude'
            ])
            ->get();

        return view('admin.dashboard', compact(
            'totalTempat',
            'totalDesa',
            'totalUser',
            'totalSektor',
            'chartSektor',
            'topDesa',
            'recentTempats',
            'mapData'
        ));
    }
}