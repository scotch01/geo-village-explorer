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
         * CHART DISTRIBUSI SEKTOR
         */
        $chartSektor = (clone $tempatQuery)
            ->selectRaw('sektor, COUNT(*) as total')
            ->groupBy('sektor')
            ->orderByDesc('total')
            ->get();

        /**
         * TOP DESA
         */
        $topDesaQuery = Tempat::query();

        if ($user->isAdminDesa()) {

            $topDesaQuery->where(
                'id_desa',
                $user->id_desa
            );
        }

        $topDesa = $topDesaQuery
            ->with([
                'desa:id,nama_desa'
            ])
            ->selectRaw('id_desa, COUNT(*) as total')
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
                'nama_tempat',
                'sektor',
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