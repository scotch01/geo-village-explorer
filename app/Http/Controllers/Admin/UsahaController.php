<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use App\Models\Usaha;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use Illuminate\Validation\ValidationException;


use App\Constants\Usaha\LokasiUsaha;
use App\Constants\Usaha\StatusKepemilikanBangunanUsaha;
use App\Constants\Shared\JenisKelamin;
use App\Constants\Shared\Pendidikan;
use App\Constants\Usaha\IzinUsaha;
use App\Constants\Usaha\BadanUsaha;
use App\Constants\Usaha\PenggunaanInternet;
use App\Constants\Usaha\MediaInternet;
use App\Constants\Usaha\TidakPenggunaanInternet;
use App\Constants\Shared\KreditSumber;
use App\Constants\Usaha\TujuanKreditUsaha;
use App\Constants\Usaha\TidakMenerimaKredit;
use App\Constants\Usaha\Kendala;

class UsahaController extends Controller
{
    public function index(
        Tempat $tempat
    )
    {
        $usahas = $tempat
            ->usahas()
            ->latest()
            ->get();

        return view(
            'admin.usaha.index',
            compact(
                'tempat',
                'usahas'
            )
        );
    }

    public function create(
        Tempat $tempat
    )
    {
        $desa = auth()->user()->desa;

        return view(
            'admin.usaha.create',
            [

                'tempat' => $tempat,

                'keluarga'
                => $tempat->keluarga,

                'lokasiUsaha'
                    => LokasiUsaha::OPTIONS,

                'statusBangunan'
                    => StatusKepemilikanBangunanUsaha::OPTIONS,

                'jenisKelamin'
                    => JenisKelamin::OPTIONS,

                'pendidikan'
                    => Pendidikan::OPTIONS,

                'izinUsaha'
                    => IzinUsaha::OPTIONS,

                'badanUsaha'
                    => BadanUsaha::OPTIONS,

                'penggunaanInternet'
                    => PenggunaanInternet::OPTIONS,

                'mediaInternet'
                    => MediaInternet::OPTIONS,

                'tidakPenggunaanInternet'
                    => TidakPenggunaanInternet::OPTIONS,

                'sumberPinjaman'
                    => KreditSumber::OPTIONS,

                'tujuanPinjaman'
                    => TujuanKreditUsaha::OPTIONS,

                'tidakMenerimaKredit'
                    => TidakMenerimaKredit::OPTIONS,

                'kendalaUsaha'
                    => Kendala::OPTIONS,
            ],
            [

                'tempat' => $tempat,
                'desa'   => $desa,

            ]
        );
    }

    public function store(
        Request $request,
        Tempat $tempat
    )
    {
        $validated =
            $this->validateData($request);

        $this->validateNik(
            $validated,
            $keluarga
        );

        $validated['tempat_id']
            = $tempat->id;

        Usaha::create(
            $validated
        );

        return redirect()
            ->route(
                'admin.usaha.index',
                $tempat
            )
            ->with(
                'success',
                'Data usaha berhasil disimpan'
            );
    }

    public function show(
        Usaha $usaha
    )
    {
        return view(
            'admin.usaha.show',
            [
                'usaha' => $usaha,
                'tempat' => $usaha->tempat,

                'lokasiUsaha'
                    => LokasiUsaha::OPTIONS,

                'statusBangunan'
                    => StatusKepemilikanBangunanUsaha::OPTIONS,

                'jenisKelamin'
                    => JenisKelamin::OPTIONS,

                'pendidikan'
                    => Pendidikan::OPTIONS,

                'izinUsaha'
                    => IzinUsaha::OPTIONS,

                'badanUsaha'
                    => BadanUsaha::OPTIONS,

                'penggunaanInternet'
                    => PenggunaanInternet::OPTIONS,

                'mediaInternet'
                    => MediaInternet::OPTIONS,

                'tidakPenggunaanInternet'
                    => TidakPenggunaanInternet::OPTIONS,

                'sumberPinjaman'
                    => KreditSumber::OPTIONS,

                'tujuanPinjaman'
                    => TujuanKreditUsaha::OPTIONS,

                'tidakMenerimaKredit'
                    => TidakMenerimaKredit::OPTIONS,

                'kendalaUsaha'
                    => Kendala::OPTIONS,
            ]
        );
    }

    public function edit(
        Usaha $usaha
    )
    {
        $tempat =
            $usaha->tempat;

        if (!$usaha) {
            abort(404);
        }

        return view(
            'admin.usaha.edit',
            [

                'tempat' => $tempat,

                'usaha' => $usaha,

                'keluarga'
                    => $tempat->keluarga,

                'lokasiUsaha'
                    => LokasiUsaha::OPTIONS,

                'statusBangunan'
                    => StatusKepemilikanBangunanUsaha::OPTIONS,

                'jenisKelamin'
                    => JenisKelamin::OPTIONS,

                'pendidikan'
                    => Pendidikan::OPTIONS,

                'izinUsaha'
                    => IzinUsaha::OPTIONS,

                'badanUsaha'
                    => BadanUsaha::OPTIONS,

                'penggunaanInternet'
                    => PenggunaanInternet::OPTIONS,

                'mediaInternet'
                    => MediaInternet::OPTIONS,

                'tidakPenggunaanInternet'
                    => TidakPenggunaanInternet::OPTIONS,

                'sumberPinjaman'
                    => KreditSumber::OPTIONS,

                'tujuanPinjaman'
                    => TujuanKreditUsaha::OPTIONS,

                'tidakMenerimaKredit'
                    => TidakMenerimaKredit::OPTIONS,

                'kendalaUsaha'
                    => Kendala::OPTIONS,
            ]
        );
    }

    public function update(
        Request $request,
        Usaha $usaha
    )
    {
        $tempat =
            $usaha->tempat;

        if (!$usaha) {
            abort(404);
        }

        $validated =
            $this->validateData($request);

        $this->validateNik(
            $validated,
            $anggota->keluarga,
            $anggota
        );

        $usaha->update(
            $validated
        );

        return redirect()
            ->route(
                'admin.usaha.index',
                $tempat
            )
            ->with(
                'warning',
                'Data usaha berhasil diperbarui'
            );
    }

    public function destroy(
        Usaha $usaha
    )
    {
        if (!auth()->user()->isMasterAdmin()) {

            abort(403);
        }

        $tempat =
            $usaha->tempat;

        if (!$usaha) {
            abort(404);
        }

        $usaha->delete();

        return redirect()
            ->route(
                'admin.usaha.index',
                $tempat
            )
            ->with(
                'danger',
                'Data usaha berhasil dihapus'
            );
    }


    private function validateData(Request $request)
    {
        return $request->validate([

            'provinsi'
                => 'nullable|string|max:255',

            'kabupaten'
                => 'nullable|string|max:255',

            'kecamatan'
                => 'nullable|string|max:255',

            'desa'
                => 'nullable|string|max:255',

            'dusun'
                => 'nullable|string|max:255',

            'alamat'
                => 'nullable|string',

            'nama_usaha'
                => 'required|string|max:255',

            'telepon'
                => 'nullable|string|max:255',

            'email'
                => 'nullable|email|max:255',

            'website'
                => 'nullable|string|max:255',
            
            'lokasi_usaha'
                => 'nullable|integer',

            'status_bangunan'
                => 'nullable|integer',

            'nama_pemilik'
                => 'nullable|string|max:255',

            'nik_pemilik'
                => 'nullable|string|max:16',

            'jenis_kelamin_pemilik'
                => 'nullable|integer',

            'tanggal_lahir_pemilik'
                => 'nullable|date|before_or_equal:today',

            'ijazah_pemilik'
                => 'nullable|integer',

            'kegiatan_utama'
                => 'nullable|string',

            'produk_utama'
                => 'nullable|string',

            'kategori_lapangan_usaha'
                => 'nullable|string|max:255',

            'kbli'
                => 'nullable|string|max:255',

            'tahun_mulai'
                => 'nullable|digits:4',

            'izin_usaha'
                => 'nullable|array',

            'bentuk_badan_usaha'
                => 'nullable|integer',

            'jumlah_pekerja_dibayar'
                => 'nullable|integer|min:0',

            'total_upah_bulanan'
                => 'nullable|numeric|min:0',

            'jumlah_pekerja_tidak_dibayar'
                => 'nullable|integer|min:0',

            'pendapatan_bulanan'
                => 'nullable|numeric|min:0',

            'pendapatan_tahunan'
                => 'nullable|numeric|min:0',

            'penggunaan_internet'
                => 'nullable|array',

            'media_internet'
                => 'nullable|array',

            'alasan_tidak_internet'
                => 'nullable|array',

            'sumber_pinjaman'
                => 'nullable|array',

            'tujuan_pinjaman'
                => 'nullable|array',

            'kendala_usaha'
                => 'nullable|array',

            'tidak_menerima_kredit'
                => 'nullable|integer',
        ],
        
        [],
        
        [
            'nama_usaha'
                => '7. Nama Usaha / Perusahaan',   
            
            'tanggal_lahir_pemilik'
                => '14d. Tanggal Lahir Pemilik',
        ]);
    }

    private function validateNik(
        array $validated,
        Keluarga $keluarga,
        ?AnggotaKeluarga $anggota = null
    )
    {
        /**
         * Kepala keluarga
         */
        if (
            $validated['hubungan_keluarga'] == 1
        ) {

            if (
                $validated['nik']
                !== $keluarga->nik_kepala_keluarga
            ) {

                throw ValidationException::withMessages([
                    'nik' =>
                        'NIK kepala keluarga harus sama dengan NIK yang terdaftar pada Data Keluarga.'
                ]);
            }

            return;
        }

        /**
         * NIK tidak boleh sama dengan kepala keluarga
         */
        if (
            $validated['nik']
            === $keluarga->nik_kepala_keluarga
        ) {

            throw ValidationException::withMessages([
                'nik' =>
                    'NIK sudah digunakan oleh kepala keluarga.'
            ]);
        }

        /**
         * NIK tidak boleh sama dengan anggota lain
         */
        $query =
            $keluarga
                ->anggotaKeluargas()
                ->where(
                    'nik',
                    $validated['nik']
                );

        if ($anggota) {

            $query->where(
                'id',
                '!=',
                $anggota->id
            );
        }

        if ($query->exists()) {

            throw ValidationException::withMessages([
                'nik' =>
                    'NIK sudah digunakan oleh anggota keluarga lain.'
            ]);
        }
    }
}