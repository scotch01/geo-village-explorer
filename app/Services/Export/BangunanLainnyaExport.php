<?php

namespace App\Services\Export;

use App\Models\BangunanLainnya;
use Illuminate\Http\Request;

class BangunanLainnyaExport
{
    public function download(Request $request)
    {
        $query = BangunanLainnya::query()
            ->with('tempat.desa');

        if ($request->filled('id_desa')) {

            $query->whereHas(
                'tempat',
                function ($q) use ($request) {

                    $q->where(
                        'id_desa',
                        $request->id_desa
                    );

                }
            );

        }

        if ($request->filled('jenis_bangunan')) {

            $query->whereHas(
                'tempat',
                function ($q) use ($request) {

                    $q->where(
                        'jenis_bangunan',
                        $request->jenis_bangunan
                    );

                }
            );

        }

        $filename =
            'bangunan_lainnya_' .
            now()
                ->timezone('Asia/Jakarta')
                ->format('Ymd_His') .
            '.csv';

        return response()->streamDownload(

            function () use ($query) {

                $handle =
                    fopen(
                        'php://output',
                        'w'
                    );

                fputcsv(
                    $handle,
                    [

                        'id',

                        'tempat_id',

                        'nama_desa',

                        'nama_infrastruktur',

                        'kategori',

                        'alamat',

                        'email',

                        'website',

                        'latitude',

                        'longitude',

                        'akurasi',

                        'created_at',

                    ]
                );

                $query
                    ->orderBy('id')
                    ->chunk(
                        500,
                        function ($rows) use ($handle) {

                            foreach ($rows as $row) {

                                fputcsv(
                                    $handle,
                                    [

                                        $row->id,

                                        $row->tempat_id,

                                        $row->tempat?->desa?->nama_desa,

                                        $row->nama_infrastruktur,

                                        $row->kategori,

                                        $row->alamat,

                                        $row->email,

                                        $row->website,

                                        $row->latitude,

                                        $row->longitude,

                                        $row->akurasi,

                                        optional($row->created_at)
                                            ->format('Y-m-d H:i:s'),

                                    ]
                                );

                            }

                        }
                    );

                fclose($handle);

            },

            $filename,

            [
                'Content-Type'
                    => 'text/csv',
            ]
        );
    }
}