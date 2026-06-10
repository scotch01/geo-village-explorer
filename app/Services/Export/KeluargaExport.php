<?php

namespace App\Services\Export;

use Illuminate\Http\Request;
use App\Models\Keluarga;

class KeluargaExport
{
    public function download(
        Request $request
    )
    {

        $query =
            Keluarga::query()
                ->with([
                    'tempat.desa',
                    'meterans',
                ]);

        if (
            $request->filled(
                'id_desa'
            )
        ) {

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

        if (
            $request->filled(
                'jenis_bangunan'
            )
        ) {

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
            'keluarga_' .
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

                        'nama_kepala_keluarga',

                        'nik_kepala_keluarga',

                        'nomor_kk',

                        'provinsi',

                        'kabupaten',

                        'kecamatan',

                        'desa',

                        'dusun',

                        'alamat_detail',

                        'alamat_sesuai_kk',

                        'jumlah_keluarga_dalam_rumah',

                        'status_kepemilikan_rumah',

                        'luas_lantai',

                        'bahan_lantai',

                        'bahan_dinding',

                        'bahan_atap',

                        'fasilitas_bab',

                        'jenis_kloset',

                        'pembuangan_tinja',

                        'sumber_air_minum',

                        'sumber_penerangan',

                        'jumlah_meteran',

                        'daya_listrik_meteran',

                        'kredit_sumber',

                        'kredit_tujuan',

                        'latitude_rumah',

                        'longitude_rumah',

                        'akurasi_rumah',

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
                                as $keluarga
                            ) {

                                fputcsv(
                                    $handle,
                                    [

                                        $keluarga->id,

                                        $keluarga->tempat_id,

                                        $keluarga->tempat?->desa?->nama_desa,

                                        $keluarga->nama_kepala_keluarga,

                                        $keluarga->nik_kepala_keluarga,

                                        $keluarga->nomor_kk,

                                        $keluarga->provinsi,

                                        $keluarga->kabupaten,

                                        $keluarga->kecamatan,

                                        $keluarga->desa,

                                        $keluarga->dusun,

                                        $keluarga->alamat_detail,

                                        $keluarga->alamat_sesuai_kk,

                                        $keluarga->jumlah_keluarga_dalam_rumah,

                                        $keluarga->status_kepemilikan_rumah,

                                        $keluarga->luas_lantai,

                                        $keluarga->bahan_lantai,

                                        $keluarga->bahan_dinding,

                                        $keluarga->bahan_atap,

                                        $keluarga->fasilitas_bab,

                                        $keluarga->jenis_kloset,

                                        $keluarga->pembuangan_tinja,

                                        $keluarga->sumber_air_minum,

                                        $keluarga->sumber_penerangan,

                                        $keluarga->meterans->count(),

                                        $keluarga->meterans
                                            ->pluck('daya_listrik')
                                            ->implode('; '),

                                        implode(
                                            '; ',
                                            $keluarga->kredit_sumber ?? []
                                        ),

                                        implode(
                                            '; ',
                                            $keluarga->kredit_tujuan ?? []
                                        ),

                                        $keluarga->latitude_rumah,

                                        $keluarga->longitude_rumah,

                                        $keluarga->akurasi_rumah,

                                        optional(
                                            $keluarga->created_at
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