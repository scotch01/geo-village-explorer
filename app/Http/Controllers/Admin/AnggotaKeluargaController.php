<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MasterProfesi;
use Illuminate\Validation\ValidationException;
use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use App\Constants\AnggotaKeluarga\HubunganKeluarga;
use App\Constants\AnggotaKeluarga\StatusPerkawinan;
use App\Constants\Shared\JenisKelamin;
use App\Constants\AnggotaKeluarga\PartisipasiSekolah;
use App\Constants\Shared\Pendidikan;
use App\Constants\AnggotaKeluarga\KedudukanPekerjaan;
use App\Constants\AnggotaKeluarga\RekeningAktif;
use App\Constants\AnggotaKeluarga\Disabilitas;
use App\Constants\AnggotaKeluarga\PenyakitKronis;
use App\Constants\AnggotaKeluarga\JaminanKesehatan;

class AnggotaKeluargaController extends Controller
{
    public function index(
        Keluarga $keluarga
    )
    {
        $anggotas = $keluarga
            ->anggotaKeluargas()
            ->orderBy('nomor_urut')
            ->get();

        return view(
            'admin.anggota.index',
            compact(
                'keluarga',
                'anggotas'
            )
        );
    }

    public function create(
        Keluarga $keluarga
    )
    {
        $nextNomorUrut = 
            $keluarga
                ->anggotaKeluargas()
                ->count() + 1;
                
        $sudahAdaKepalaKeluarga =
            $keluarga
                ->anggotaKeluargas()
                ->where(
                    'hubungan_keluarga',
                    1
                )
                ->exists();
        return view(
            'admin.anggota.create',
            [

                'keluarga' => $keluarga,

                'nextNomorUrut'
                    => $nextNomorUrut,

                'sudahAdaKepalaKeluarga'
                    => $sudahAdaKepalaKeluarga,

                'hubunganKeluarga'
                    => HubunganKeluarga::OPTIONS,

                'statusPerkawinan'
                    => StatusPerkawinan::OPTIONS,

                'jenisKelamin'
                    => JenisKelamin::OPTIONS,

                'partisipasiSekolah'
                    => PartisipasiSekolah::OPTIONS,

                'pendidikan'
                    => Pendidikan::OPTIONS,

                'kedudukanPekerjaan'
                    => KedudukanPekerjaan::OPTIONS,

                'rekeningAktif'
                    => RekeningAktif::OPTIONS,

                'disabilitas'
                    => Disabilitas::OPTIONS,

                'penyakitKronis'
                    => PenyakitKronis::OPTIONS,

                'jaminanKesehatan'
                    => JaminanKesehatan::OPTIONS,

            ]
        );
    }

    public function store(
        Request $request,
        Keluarga $keluarga
    )
    {
        $validated =
            $this->validateData($request);

        $validated['keluarga_id']
            = $keluarga->id;

        $validated['nomor_urut'] =
            $keluarga
                ->anggotaKeluargas()
                ->count() + 1;

        if (
            $validated['hubungan_keluarga'] == 1
        ) {

            $exists =
                $keluarga
                    ->anggotaKeluargas()
                    ->where(
                        'hubungan_keluarga',
                        1
                    )
                    ->exists();

            if ($exists) {

                return back()
                    ->withErrors([
                        'hubungan_keluarga'
                            => 'Kepala keluarga sudah ada.'
                    ])
                    ->withInput();
            }
        }

        AnggotaKeluarga::create(
            $validated
        );

        return redirect()
            ->route(
                'admin.anggota.index',
                $keluarga
            )
            ->with(
                'success',
                'Data anggota keluarga berhasil ditambahkan.'
            );
    }

    public function show(
        AnggotaKeluarga $anggota
    )
    {
        return view(
            'admin.anggota.show',
            [

                'anggota' => $anggota,

                'hubunganKeluarga'
                    => HubunganKeluarga::OPTIONS,

                'statusPerkawinan'
                    => StatusPerkawinan::OPTIONS,

                'jenisKelamin'
                    => JenisKelamin::OPTIONS,

                'partisipasiSekolah'
                    => PartisipasiSekolah::OPTIONS,

                'pendidikan'
                    => Pendidikan::OPTIONS,

                'kedudukanPekerjaan'
                    => KedudukanPekerjaan::OPTIONS,

                'rekeningAktif'
                    => RekeningAktif::OPTIONS,

                'disabilitas'
                    => Disabilitas::OPTIONS,

                'penyakitKronis'
                    => PenyakitKronis::OPTIONS,

                'jaminanKesehatan'
                    => JaminanKesehatan::OPTIONS,
            ]
        );
    }

    public function edit(
        AnggotaKeluarga $anggota
    )
    {
        $keluarga =
            $anggota->keluarga;

        $sudahAdaKepalaKeluarga =
            $keluarga
                ->anggotaKeluargas()
                ->where(
                    'hubungan_keluarga',
                    1
                )
                ->where(
                    'id',
                    '!=',
                    $anggota->id
                )
                ->exists();

        return view(
            'admin.anggota.edit',
            [

                'anggota' => $anggota,

                'sudahAdaKepalaKeluarga' => $sudahAdaKepalaKeluarga,

                'hubunganKeluarga'
                    => HubunganKeluarga::OPTIONS,

                'statusPerkawinan'
                    => StatusPerkawinan::OPTIONS,

                'jenisKelamin'
                    => JenisKelamin::OPTIONS,

                'partisipasiSekolah'
                    => PartisipasiSekolah::OPTIONS,

                'pendidikan'
                    => Pendidikan::OPTIONS,

                'kedudukanPekerjaan'
                    => KedudukanPekerjaan::OPTIONS,

                'rekeningAktif'
                    => RekeningAktif::OPTIONS,

                'disabilitas'
                    => Disabilitas::OPTIONS,

                'penyakitKronis'
                    => PenyakitKronis::OPTIONS,

                'jaminanKesehatan'
                    => JaminanKesehatan::OPTIONS,

            ]
        );
    }

    public function update(
        Request $request,
        AnggotaKeluarga $anggota
    )
    {
        $validated =
            $this->validateData($request);

        if (
            $validated['hubungan_keluarga'] == 1
        ) {

            $exists =
                $anggota
                    ->keluarga
                    ->anggotaKeluargas()
                    ->where(
                        'hubungan_keluarga',
                        1
                    )
                    ->where(
                        'id',
                        '!=',
                        $anggota->id
                    )
                    ->exists();

            if ($exists) {

                return back()
                    ->withErrors([
                        'hubungan_keluarga'
                            => 'Kepala keluarga sudah ada.'
                    ])
                    ->withInput();
            }
        }

        $anggota->update(
            $validated
        );

        return redirect()
            ->route(
                'admin.anggota.index',
                $anggota->keluarga
            )
            ->with(
                'warning',
                'Data anggota keluarga berhasil diperbarui'
            );
    }

    public function destroy(
        AnggotaKeluarga $anggota
    )
    {

        $keluarga =
            $anggota->keluarga;

        $anggota->delete();

        $keluarga
            ->anggotaKeluargas()
            ->orderBy('nomor_urut')
            ->get()
            ->each(function ($item, $index) {

                $item->update([
                    'nomor_urut' => $index + 1
                ]);

            });

        return redirect()
            ->route(
                'admin.anggota.index',
                $keluarga
            )
            ->with(
                'danger',
                'Data anggota keluarga berhasil dihapus'
            );
    }

    private function validateData(
        Request $request
    )
    {
        $validated = $request->validate([

            'nomor_urut'
                => 'required|integer|min:1|max:99',

            'nama'
                => 'required|string|max:255',

            'nik'
                => 'required|string|size:16',

            'hubungan_keluarga'
                => 'required|integer',

            'status_perkawinan'
                => 'required|integer',

            'tanggal_lahir'
                => 'required|date',

            'jenis_kelamin'
                => 'required|integer',

            'partisipasi_sekolah'
                => 'nullable|integer',

            'ijazah_tertinggi'
                => 'nullable|integer',

            'status_pekerjaan'
                => 'nullable|integer',

            'master_profesi_id'
                => 'nullable|exists:master_profesis,id',

            'kode_profesi'
                => 'nullable|string|max:10',

            'rekening_digital'
                => 'nullable|integer',

            'disabilitas'
                => 'nullable|array',

            'disabilitas.*'
                => 'string',

            'penyakit_kronis'
                => 'nullable|array',

            'penyakit_kronis.*'
                => 'string',

            'jaminan_kesehatan'
                => 'nullable|array',

            'jaminan_kesehatan.*'
                => 'string',

        ],
        
        [],
        
        [
            'nomor_urut'
                => '5. Nomor Urut Anggota Keluarga',

            'nama'
                => '6. Nama Anggota Keluarga',

            'nik'
                => '7. Nomor Induk Kependudukan (NIK)',

            'hubungan_keluarga'
                => '8. Hubungan dengan Kepala Keluarga',

            'status_perkawinan'
                => '9. Status Perkawinan',

            'tanggal_lahir'
                => '10. Tanggal Lahir',

            'jenis_kelamin'
                => '11. Jenis Kelamin',   
        ]);

        $umur = Carbon::parse(
            $request->tanggal_lahir
        )->age;

        /*
        |--------------------------------------------------------------------------
        | Validasi Pendidikan
        |--------------------------------------------------------------------------
        */

        if (
            $umur < 5 &&
            (
                $request->filled('partisipasi_sekolah') ||
                $request->filled('ijazah_tertinggi')
            )
        ) {

            throw ValidationException::withMessages([
                'tanggal_lahir' =>
                    'Data pendidikan hanya berlaku untuk usia 5 tahun ke atas.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi Pekerjaan
        |--------------------------------------------------------------------------
        */

        if (
            $umur < 10 &&
            (
                $request->filled('master_profesi_id') ||
                $request->filled('status_pekerjaan')
            )
        ) {

            throw ValidationException::withMessages([
                'tanggal_lahir' =>
                    'Data pekerjaan hanya berlaku untuk usia 10 tahun ke atas.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Profesi Tidak Bekerja (000)
        |--------------------------------------------------------------------------
        */

        if ($request->filled('master_profesi_id')) {

            $profesi = MasterProfesi::find(
                $request->master_profesi_id
            );

            if (
                $profesi &&
                $profesi->kode === '000' &&
                $request->filled('status_pekerjaan')
            ) {

                throw ValidationException::withMessages([
                    'status_pekerjaan' =>
                        'Status kedudukan pekerjaan tidak boleh diisi jika profesi adalah Tidak Bekerja.'
                ]);
            }
        }

        return $validated;

    }
}
