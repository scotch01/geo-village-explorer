<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Tempat;
use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use App\Models\Usaha;
use Illuminate\Http\Request;

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
        Request $request
    )
    {
        $dataset =
            $request->dataset;

        return match ($dataset) {

            'tempat'
                => $this->exportTempat(
                    $request
                ),

            'keluarga'
                => $this->exportKeluarga(
                    $request
                ),

            'anggota'
                => $this->exportAnggota(
                    $request
                ),

            'usaha'
                => $this->exportUsaha(
                    $request
                ),

            default
                => abort(404),

        };
    }

    private function exportTempat(
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
    private function exportKeluarga(
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

    private function exportAnggota(
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

    private function exportUsaha(
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