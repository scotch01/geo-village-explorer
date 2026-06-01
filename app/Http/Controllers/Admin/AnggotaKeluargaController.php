<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return view(
            'admin.anggota.create',
            [

                'keluarga' => $keluarga,

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
                'Anggota keluarga berhasil ditambahkan.'
            );
            }

    public function edit(
        AnggotaKeluarga $anggota
    )
    {
        return view(
            'admin.anggota.edit',
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

    public function update(
        Request $request,
        AnggotaKeluarga $anggota
    )
    {
        $validated =
            $this->validateData($request);

        $anggota->update(
            $validated
        );

        return redirect()
            ->route(
                'admin.anggota.index',
                $anggota->keluarga
            )
            ->with(
                'success',
                'Data anggota berhasil diperbarui'
            );
    }

    public function destroy(
        AnggotaKeluarga $anggota
    )
    {
        $keluarga =
            $anggota->keluarga;

        $anggota->delete();

        return redirect()
            ->route(
                'admin.anggota.index',
                $keluarga
            )
            ->with(
                'success',
                'Data anggota berhasil dihapus'
            );
    }

    private function validateData(
        Request $request
    )
    {
        return $request->validate([

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

        ]);
    }
}
