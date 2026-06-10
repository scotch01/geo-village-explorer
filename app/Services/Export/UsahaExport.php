<?php

namespace App\Services\Export;

use Illuminate\Http\Request;
use App\Models\Usaha;

class UsahaExport
{
    public function download(
        Request $request
    )
    {
        $query =
            Usaha::query()
                ->with([
                    'tempat.desa',
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
            'usaha_' .
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

                        'provinsi',

                        'kabupaten',

                        'kecamatan',

                        'desa',

                        'dusun',

                        'alamat',

                        'nama_usaha',

                        'telepon',

                        'email',

                        'website',

                        'nama_pemilik',

                        'nik_pemilik',

                        'jenis_kelamin_pemilik',

                        'tanggal_lahir_pemilik',

                        'ijazah_pemilik',

                        'lokasi_usaha',

                        'status_bangunan',

                        'kegiatan_utama',

                        'produk_utama',

                        'kategori_lapangan_usaha',

                        'kbli',

                        'tahun_mulai',

                        'izin_usaha',

                        'bentuk_badan_usaha',

                        'jumlah_pekerja_dibayar',

                        'total_upah_bulanan',

                        'jumlah_pekerja_tidak_dibayar',

                        'pendapatan_bulanan',

                        'pendapatan_tahunan',

                        'penggunaan_internet',

                        'media_internet',

                        'alasan_tidak_internet',

                        'sumber_pinjaman',

                        'tujuan_pinjaman',

                        'tidak_menerima_kredit',

                        'kendala_usaha',

                        'lokasi_sama_dengan_keluarga',

                        'created_at',

                    ]
                );

                $query
                    ->orderBy('id')
                    ->chunk(
                        500,
                        function ($rows) use ($handle) {

                            foreach (
                                $rows
                                as $usaha
                            ) {

                                fputcsv(
                                    $handle,
                                    [

                                        $usaha->id,

                                        $usaha->tempat_id,

                                        $usaha->tempat?->desa?->nama_desa,

                                        $usaha->provinsi,

                                        $usaha->kabupaten,

                                        $usaha->kecamatan,

                                        $usaha->desa,

                                        $usaha->dusun,

                                        $usaha->alamat,

                                        $usaha->nama_usaha,

                                        $usaha->telepon,

                                        $usaha->email,

                                        $usaha->website,

                                        $usaha->nama_pemilik,

                                        $usaha->nik_pemilik,

                                        $usaha->jenis_kelamin_pemilik,

                                        $usaha->tanggal_lahir_pemilik,

                                        $usaha->ijazah_pemilik,

                                        $usaha->lokasi_usaha,

                                        $usaha->status_bangunan,

                                        $usaha->kegiatan_utama,

                                        $usaha->produk_utama,

                                        $usaha->kategori_lapangan_usaha,

                                        $usaha->kbli,

                                        $usaha->tahun_mulai,

                                        implode(
                                            '; ',
                                            $usaha->izin_usaha ?? []
                                        ),

                                        $usaha->bentuk_badan_usaha,

                                        $usaha->jumlah_pekerja_dibayar,

                                        $usaha->total_upah_bulanan,

                                        $usaha->jumlah_pekerja_tidak_dibayar,

                                        $usaha->pendapatan_bulanan,

                                        $usaha->pendapatan_tahunan,

                                        implode(
                                            '; ',
                                            $usaha->penggunaan_internet ?? []
                                        ),

                                        implode(
                                            '; ',
                                            $usaha->media_internet ?? []
                                        ),

                                        implode(
                                            '; ',
                                            $usaha->alasan_tidak_internet ?? []
                                        ),

                                        implode(
                                            '; ',
                                            $usaha->sumber_pinjaman ?? []
                                        ),

                                        implode(
                                            '; ',
                                            $usaha->tujuan_pinjaman ?? []
                                        ),

                                        $usaha->tidak_menerima_kredit,

                                        implode(
                                            '; ',
                                            $usaha->kendala_usaha ?? []
                                        ),

                                        $usaha->lokasi_sama_dengan_keluarga,

                                        optional(
                                            $usaha->created_at
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