<?php

namespace App\Services\Export;

use Illuminate\Http\Request;
use App\Models\Tempat;

class TempatExport
{
    public function download(
        Request $request
    )
     {

        $query =
            Tempat::query()
                ->with([
                    'desa',
                    'creator',
                ]);

        if (
            $request->filled(
                'id_desa'
            )
        ) {

            $query->where(
                'id_desa',
                $request->id_desa
            );

        }

        if (
            $request->filled(
                'jenis_bangunan'
            )
        ) {

            $query->where(
                'jenis_bangunan',
                $request->jenis_bangunan
            );

        }

        $filename =
            'tempat_' .
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

                        'jenis_bangunan',

                        'catatan',

                        'nama_desa',

                        'nama_petugas',

                        'created_at',

                    ]
                );

                $query
                    ->orderBy('id')
                    ->chunk(
                        500,
                        function (
                            $rows
                        ) use (
                            $handle
                        ) {

                            foreach (
                                $rows
                                as $tempat
                            ) {

                                fputcsv(
                                    $handle,
                                    [

                                        $tempat->id,

                                        $tempat->jenis_bangunan,

                                        $tempat->catatan,

                                        $tempat->desa?->nama_desa,

                                        $tempat->creator?->name,

                                        optional(
                                            $tempat->created_at
                                        )->format(
                                            'Y-m-d H:i:s'
                                        ),

                                    ]
                                );

                            }

                        }
                    );

                fclose(
                    $handle
                );

            },

            $filename,

            [
                'Content-Type'
                    => 'text/csv',
            ]
        );
    }
}