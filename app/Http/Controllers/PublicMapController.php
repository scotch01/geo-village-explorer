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
            ->with([
                'desa',

                'keluarga.anggotaKeluargas',

                'usahas',
            ]);

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
         * FILTER JENIS BANGUNAN
         */
        if ($request->filled('jenis_bangunan')) {

            $query->where(
                'jenis_bangunan',
                $request->jenis_bangunan
            );
        }

        /**
         * SEARCH
         */
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->whereHas(
                    'keluarga',
                    function ($keluarga) use ($search) {

                        $keluarga->where(
                            'nama_kepala_keluarga',
                            'like',
                            "%{$search}%"
                        );
                    }
                )

                ->orWhereHas(
                    'usahas',
                    function ($usaha) use ($search) {

                        $usaha->where(
                            'nama_usaha',
                            'like',
                            "%{$search}%"
                        );
                    }
                );
            });
        }

        $tempats = $query
            ->latest()
            ->get();

        $mapData = [];

        foreach ($tempats as $tempat) {

            /**
             * BTT
             */
            if (
                $tempat->jenis_bangunan === 'btt'
                && $tempat->keluarga
                && $tempat->keluarga->latitude_rumah
                && $tempat->keluarga->longitude_rumah
            ) {

                $mapData[] = [

                    'type' => 'btt',

                    'lat'
                        => $tempat
                            ->keluarga
                            ->latitude_rumah,

                    'lng'
                        => $tempat
                            ->keluarga
                            ->longitude_rumah,

                    'desa'
                        => $tempat
                            ->desa
                            ?->nama_desa,

                    'nama_kepala_keluarga'
                        => $tempat
                            ->keluarga
                            ->nama_kepala_keluarga,

                    'jumlah_anggota'
                        => $tempat
                            ->keluarga
                            ->anggotaKeluargas
                            ->count() + 1,
                ];
            }

            /**
             * BKU
             */
            if (
                $tempat->jenis_bangunan === 'bku'
            ) {

                foreach (
                    $tempat->usahas
                    as $usaha
                ) {

                    if (
                        !$usaha->latitude_usaha ||
                        !$usaha->longitude_usaha
                    ) {
                        continue;
                    }

                    $mapData[] = [

                        'type' => 'bku',

                        'lat'
                            => $usaha->latitude_usaha,

                        'lng'
                            => $usaha->longitude_usaha,

                        'desa'
                            => $tempat
                                ->desa
                                ?->nama_desa,

                        'nama_usaha'
                            => $usaha->nama_usaha,

                        'nama_pemilik'
                            => $usaha->nama_pemilik,

                        'kegiatan_utama'
                            => $usaha->kegiatan_utama,

                        'produk_utama'
                            => $usaha->produk_utama,
                    ];
                }
            }

            /**
             * BC
             */
            if (
                $tempat->jenis_bangunan === 'bc'
                && $tempat->keluarga
                && $tempat->keluarga->latitude_rumah
                && $tempat->keluarga->longitude_rumah
            ) {

                $mapData[] = [

                    'type' => 'bc',

                    'lat'
                        => $tempat
                            ->keluarga
                            ->latitude_rumah,

                    'lng'
                        => $tempat
                            ->keluarga
                            ->longitude_rumah,

                    'desa'
                        => $tempat
                            ->desa
                            ?->nama_desa,

                    'nama_kepala_keluarga'
                        => $tempat
                            ->keluarga
                            ->nama_kepala_keluarga,

                    'jumlah_anggota'
                        => $tempat
                            ->keluarga
                            ->anggotaKeluargas
                            ->count() + 1,

                    'usahas'
                        => $tempat
                            ->usahas
                            ->map(function ($usaha) {

                                return [

                                    'nama_usaha'
                                        => $usaha->nama_usaha,

                                    'nama_pemilik'
                                        => $usaha->nama_pemilik,

                                    'kegiatan_utama'
                                        => $usaha->kegiatan_utama,

                                    'produk_utama'
                                        => $usaha->produk_utama,
                                ];
                            })
                            ->values()
                            ->toArray(),
                ];
            }
        }

        return view('public.spectra', [

            'mapData'
                => $mapData,

            'desas'
                => Desa::orderBy(
                    'nama_desa'
                )->get(),

            'totalBangunan'
                => $tempats->count(),

            'totalKeluarga'
                => $tempats
                    ->whereNotNull('keluarga')
                    ->count(),

            'totalUsaha'
                => $tempats
                    ->sum(
                        fn ($tempat)
                            => $tempat
                                ->usahas
                                ->count()
                    ),
        ]);
    }
}