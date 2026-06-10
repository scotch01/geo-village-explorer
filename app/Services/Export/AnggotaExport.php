<?php

namespace App\Services\Export;

use Illuminate\Http\Request;
use App\Models\AnggotaKeluarga;

class AnggotaExport
{
    public function download(
        Request $request
    )
    {
        $query =
            AnggotaKeluarga::query()
                ->with([
                    'keluarga.tempat.desa',
                    'profesi',
                ]);

        if (
            $request->filled(
                'id_desa'
            )
        ) {

            $query->whereHas(
                'keluarga.tempat',
                function ($q) use ($request) {

                    $q->where(
                        'id_desa',
                        $request->id_desa
                    );

                }
            );

        }

        if (
            $request->filled(
                'jenis_bangunan'
            )
        ) {

            $query->whereHas(
                'keluarga.tempat',
                function ($q) use ($request) {

                    $q->where(
                        'jenis_bangunan',
                        $request->jenis_bangunan
                    );

                }
            );

        }

        $filename =
            'anggota_keluarga_' .
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

                        'keluarga_id',

                        'tempat_id',

                        'nama_desa',

                        'nomor_urut',

                        'nama',

                        'nik',

                        'hubungan_keluarga',

                        'status_perkawinan',

                        'tanggal_lahir',

                        'jenis_kelamin',

                        'partisipasi_sekolah',

                        'ijazah_tertinggi',

                        'kode_profesi',

                        'nama_profesi',

                        'status_pekerjaan',

                        'rekening_digital',

                        'disabilitas',

                        'penyakit_kronis',

                        'jaminan_kesehatan',

                        'created_at',

                    ]
                );

                $query
                    ->orderBy(
                        'id'
                    )
                    ->chunk(
                        500,
                        function ($rows) use ($handle) {

                            foreach (
                                $rows
                                as $anggota
                            ) {

                                fputcsv(
                                    $handle,
                                    [

                                        $anggota->id,

                                        $anggota->keluarga_id,

                                        $anggota->keluarga?->tempat_id,

                                        $anggota->keluarga?->tempat?->desa?->nama_desa,

                                        $anggota->nomor_urut,

                                        $anggota->nama,

                                        $anggota->nik,

                                        $anggota->hubungan_keluarga,

                                        $anggota->status_perkawinan,

                                        $anggota->tanggal_lahir,

                                        $anggota->jenis_kelamin,

                                        $anggota->partisipasi_sekolah,

                                        $anggota->ijazah_tertinggi,

                                        $anggota->kode_profesi,

                                        $anggota->profesi?->nama,

                                        $anggota->status_pekerjaan,

                                        $anggota->rekening_digital,

                                        implode(
                                            '; ',
                                            $anggota->disabilitas ?? []
                                        ),

                                        implode(
                                            '; ',
                                            $anggota->penyakit_kronis ?? []
                                        ),

                                        implode(
                                            '; ',
                                            $anggota->jaminan_kesehatan ?? []
                                        ),

                                        optional(
                                            $anggota->created_at
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