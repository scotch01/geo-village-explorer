<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Tempat;
use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use App\Models\Usaha;
use Illuminate\Http\Request;

use App\Services\Export\ExportService;

class ExportController extends Controller
{
    public function index(
        Request $request
    )
    {

        $dataset =
            $request->dataset
            ?? 'tempat';

        $desaId =
            $request->id_desa;

        $jenisBangunan =
            $request->jenis_bangunan;

        /*
        |--------------------------------------------------------------------------
        | TEMPAT
        |--------------------------------------------------------------------------
        */

        $tempatQuery =
            Tempat::query();

        if ($desaId) {

            $tempatQuery->where(
                'id_desa',
                $desaId
            );
        }

        if ($jenisBangunan) {

            $tempatQuery->where(
                'jenis_bangunan',
                $jenisBangunan
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KELUARGA
        |--------------------------------------------------------------------------
        */

        $keluargaQuery =
            Keluarga::query()
                ->whereHas(
                    'tempat',
                    function ($query)
                    use (
                        $desaId,
                        $jenisBangunan
                    ) {

                        if ($desaId) {

                            $query->where(
                                'id_desa',
                                $desaId
                            );
                        }

                        if ($jenisBangunan) {

                            $query->where(
                                'jenis_bangunan',
                                $jenisBangunan
                            );
                        }

                    }
                );

        /*
        |--------------------------------------------------------------------------
        | ANGGOTA
        |--------------------------------------------------------------------------
        */

        $anggotaQuery =
            AnggotaKeluarga::query()
                ->whereHas(
                    'keluarga.tempat',
                    function ($query)
                    use (
                        $desaId,
                        $jenisBangunan
                    ) {

                        if ($desaId) {

                            $query->where(
                                'id_desa',
                                $desaId
                            );
                        }

                        if ($jenisBangunan) {

                            $query->where(
                                'jenis_bangunan',
                                $jenisBangunan
                            );
                        }

                    }
                );

        /*
        |--------------------------------------------------------------------------
        | USAHA
        |--------------------------------------------------------------------------
        */

        $usahaQuery =
            Usaha::query()
                ->whereHas(
                    'tempat',
                    function ($query)
                    use (
                        $desaId,
                        $jenisBangunan
                    ) {

                        if ($desaId) {

                            $query->where(
                                'id_desa',
                                $desaId
                            );
                        }

                        if ($jenisBangunan) {

                            $query->where(
                                'jenis_bangunan',
                                $jenisBangunan
                            );
                        }

                    }
                );

        $summary = [

            'tempat'
                => $tempatQuery->count(),

            'keluarga'
                => $keluargaQuery->count(),

            'anggota'
                => $anggotaQuery->count(),

            'usaha'
                => $usahaQuery->count(),

        ];

        return view(
            'admin.export.index',
            [

                'dataset'
                    => $dataset,

                'summary'
                    => $summary,

                'desas'
                    => Desa::orderBy(
                        'nama_desa'
                    )->get(),

            ]
        );
    }

    public function download(
        Request $request,
        ExportService $service
    )
    {
        return $service->download(
            $request
        );
    }
}