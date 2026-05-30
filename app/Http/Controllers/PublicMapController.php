<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Tempat;
use Illuminate\Http\Request;

class PublicMapController extends Controller
{
    public function index(Request $request)
    {
        $query = Tempat::query()
            ->with('desa');

        /**
         * FILTER SEKTOR
         */
        if ($request->filled('sektor')) {

            $query->where(
                'sektor',
                $request->sektor
            );
        }

        /**
         * FILTER DESA
         */
        if ($request->filled('desa')) {

            $query->where(
                'id_desa',
                $request->desa
            );
        }

        /**
         * SEARCH
         */
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'nama_tempat',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'alamat',
                    'like',
                    '%' . $request->search . '%'
                );
            });
        }

        $tempats = $query
            ->latest()
            ->get();

        return view('public.peta', [
            'tempats' => $tempats,
            'desas' => Desa::orderBy('nama_desa')->get(),
            // 'sektors' => Tempat::SEKTOR,
        ]);
    }
}