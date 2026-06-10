<?php

namespace App\Services\Export;

use Illuminate\Http\Request;
use App\Services\Export\TempatExport;
use App\Services\Export\KeluargaExport;
use App\Services\Export\AnggotaExport;
use App\Services\Export\UsahaExport;

class ExportService
{
    public function download(
        Request $request
    )
    {
        return match (
            $request->dataset
        ) {

            'tempat'
                => app(
                    TempatExport::class
                )->download($request),

            'keluarga'
                => app(
                    KeluargaExport::class
                )->download($request),

            'anggota'
                => app(
                    AnggotaExport::class
                )->download($request),

            'usaha'
                => app(
                    UsahaExport::class
                )->download($request),

            default
                => abort(404),
        };
    }
}