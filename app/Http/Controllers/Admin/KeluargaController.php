<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Constants\Keluarga\StatusKepemilikanRumah;
use App\Constants\Keluarga\BahanLantai;
use App\Constants\Keluarga\BahanDinding;
use App\Constants\Keluarga\BahanAtap;
use App\Constants\Keluarga\FasilitasBAB;
use App\Constants\Keluarga\JenisKloset;
use App\Constants\Keluarga\PembuanganTinja;
use App\Constants\Keluarga\SumberAirMinum;
use App\Constants\Keluarga\SumberPenerangan;
use App\Constants\Keluarga\DayaListrik;
use App\Constants\Shared\KreditSumber;
use App\Constants\Keluarga\KreditTujuan;
use App\Constants\Shared\YaTidak;
use App\Constants\Desa\Dusun;

class KeluargaController extends Controller
{
    public function create(Tempat $tempat)
    {
        if (!auth()->user()->canEditTempat($tempat)) {
            abort(403);
        }

        $desa = auth()->user()->desa;

        return view(
            'admin.keluarga.create',
            [
                'tempat' => $tempat,
                'desa'   => $desa,

                'yaTidak' => YaTidak::OPTIONS,

                'statusKepemilikanRumah'
                    => StatusKepemilikanRumah::OPTIONS,

                'bahanLantai'
                    => BahanLantai::OPTIONS,

                'bahanDinding'
                    => BahanDinding::OPTIONS,

                'bahanAtap'
                    => BahanAtap::OPTIONS,

                'fasilitasBab'
                    => FasilitasBAB::OPTIONS,

                'jenisKloset'
                    => JenisKloset::OPTIONS,

                'pembuanganTinja'
                    => PembuanganTinja::OPTIONS,

                'sumberAirMinum'
                    => SumberAirMinum::OPTIONS,

                'sumberPenerangan'
                    => SumberPenerangan::OPTIONS,

                'dayaListrik'
                    => DayaListrik::OPTIONS,

                'kreditSumber'
                    => KreditSumber::OPTIONS,

                'kreditTujuan'
                    => KreditTujuan::OPTIONS,

                'dusuns'
                    => Dusun::OPTIONS[$tempat->id_desa] ?? [],

            ]
        );
    }

    public function store(
        Request $request,
        Tempat $tempat
    )
    {
        if (!auth()->user()->canEditTempat($tempat)) {
            abort(403);
        }

        if ($tempat->keluarga) {

            return redirect()
                ->route(
                    'admin.tempat.survey',
                    $tempat
                )
                ->with(
                    'error',
                    'Data keluarga sudah tersedia'
                );
        }

        $validated = $this->validateData(
            $request,
            $tempat
        );

        $meterans = $validated['meterans'] ?? [];

        unset($validated['meterans']);

        $validated['tempat_id']
            = $tempat->id;

        $keluarga = Keluarga::create($validated);

        if ($request->redirect_to === 'anggota') {

            return redirect()
                ->route(
                    'admin.anggota.create',
                    $keluarga
                )
                ->with(
                    'success',
                    'Data keluarga berhasil disimpan.'
                );
        }

        if ($request->filled('meterans')) {

            foreach ($request->meterans as $meteran) {

                $keluarga
                    ->meterans()
                    ->create([
                        'daya_listrik'
                            => $meteran['daya_listrik'],
                    ]);
            }
        }

        return redirect()
            ->route(
                'admin.keluarga.show',
                $tempat
            )
            ->with(
                'success',
                'Data keluarga berhasil disimpan'
            );
    }

    public function show(Tempat $tempat)
    {
        if (!auth()->user()->canViewTempat($tempat)) {
            abort(403);
        }

        $tempat->load([
            'keluarga',
            'keluarga.anggotaKeluargas',
            'keluarga.meterans',
        ]);

        abort_if(!$tempat->keluarga, 404);

        return view(
            'admin.keluarga.show',
            [
                'tempat'   => $tempat,
                'keluarga' => $tempat->keluarga,

                'yaTidak' => YaTidak::OPTIONS,

                'statusKepemilikanRumah'
                    => StatusKepemilikanRumah::OPTIONS,

                'bahanLantai'
                    => BahanLantai::OPTIONS,

                'bahanDinding'
                    => BahanDinding::OPTIONS,

                'bahanAtap'
                    => BahanAtap::OPTIONS,

                'fasilitasBab'
                    => FasilitasBAB::OPTIONS,

                'jenisKloset'
                    => JenisKloset::OPTIONS,

                'pembuanganTinja'
                    => PembuanganTinja::OPTIONS,

                'sumberAirMinum'
                    => SumberAirMinum::OPTIONS,

                'sumberPenerangan'
                    => SumberPenerangan::OPTIONS,

                'dayaListrik'
                    => DayaListrik::OPTIONS,

                'kreditSumber'
                    => KreditSumber::OPTIONS,

                'kreditTujuan'
                    => KreditTujuan::OPTIONS,
            ]
        );
    }

    public function edit(
        Tempat $tempat
    )
    {
        if (!auth()->user()->canEditTempat($tempat)) {
            abort(403);
        }

        $keluarga = $tempat
            ->keluarga()
            ->with('meterans')
            ->first();

        if (!$keluarga) {
            abort(404);
        }

        return view(
            'admin.keluarga.edit',
            [
                'tempat' => $tempat,
                'keluarga' => $keluarga,

                'yaTidak' => YaTidak::OPTIONS,

                'statusKepemilikanRumah'
                    => StatusKepemilikanRumah::OPTIONS,

                'bahanLantai'
                    => BahanLantai::OPTIONS,

                'bahanDinding'
                    => BahanDinding::OPTIONS,

                'bahanAtap'
                    => BahanAtap::OPTIONS,

                'fasilitasBab'
                    => FasilitasBAB::OPTIONS,

                'jenisKloset'
                    => JenisKloset::OPTIONS,

                'pembuanganTinja'
                    => PembuanganTinja::OPTIONS,

                'sumberAirMinum'
                    => SumberAirMinum::OPTIONS,

                'sumberPenerangan'
                    => SumberPenerangan::OPTIONS,

                'dayaListrik'
                    => DayaListrik::OPTIONS,

                'kreditSumber'
                    => KreditSumber::OPTIONS,

                'kreditTujuan'
                    => KreditTujuan::OPTIONS,

                'dusuns'
                    => Dusun::OPTIONS[$tempat->id_desa] ?? [],
            ]
        );
    }

    public function update(
        Request $request,
        Tempat $tempat
    )
    {
        if (!auth()->user()->canEditTempat($tempat)) {
            abort(403);
        }

        $keluarga =
            $tempat->keluarga;

        if (!$keluarga) {
            abort(404);
        }

        $validated = $this->validateData(
            $request,
            $tempat,
            $keluarga
        );

        /**
         * Simpan data meteran terpisah
         */

        $meterans =
            $validated['meterans'] ?? [];

        unset($validated['meterans']);

        /**
         * Update data keluarga
         */

        $keluarga->update(
            $validated
        );

        /**
         * Reset meteran lama
         */

        $keluarga
            ->meterans()
            ->delete();

        /**
         * Simpan meteran baru
         */

        foreach ($meterans as $meteran) {

            $keluarga
                ->meterans()
                ->create([
                    'daya_listrik'
                        => $meteran['daya_listrik'],
                ]);
        }

        return redirect()
            ->route(
                'admin.keluarga.show',
                $tempat
            )
            ->with(
                'warning',
                'Data keluarga berhasil diperbarui'
            );
    }

    public function destroy(
        Tempat $tempat
    )
    {
        if (!auth()->user()->isMasterAdmin()) {

            abort(403);
        }

        $keluarga =
            $tempat->keluarga;

        if (!$keluarga) {
            abort(404);
        }

        $keluarga->delete();

        return redirect()
            ->route(
                'admin.tempat.survey',
                $tempat
            )
            ->with(
                'danger',
                'Data keluarga berhasil dihapus'
            );
    }

    private function validateData(
        Request $request,
        Tempat $tempat,
        ?Keluarga $keluarga = null
    )
    {
        $dusuns =
            Dusun::OPTIONS[$tempat->id_desa] ?? [];
        return $request->validate([

            'nama_kepala_keluarga'
                => 'required|string|max:255',

            'nik_kepala_keluarga' => [

                'required',
                'string',
                'size:16',

                Rule::unique(
                    'keluargas',
                    'nik_kepala_keluarga'
                )->ignore(
                    $keluarga?->id
                ),

            ],

            'nomor_kk' => [

                'required',
                'string',
                'size:16',

                Rule::unique(
                    'keluargas',
                    'nomor_kk'
                )->ignore(
                    $keluarga?->id
                ),

            ],

            'provinsi'
                => 'required|string|max:255',

            'kabupaten'
                => 'required|string|max:255',

            'kecamatan'
                => 'required|string|max:255',

            'desa'
                => 'required|string|max:255',
            
            'dusun' => [
                'required',
                Rule::in($dusuns),
            ],

            'alamat_detail'
                => 'required|string',

            'alamat_sesuai_kk'
                => 'nullable|integer|in:1,2',

            'jumlah_keluarga_dalam_rumah'
                => 'nullable|integer|min:1|max:99',

            'status_kepemilikan_rumah'
                => 'nullable|integer',

            'luas_lantai'
                => 'nullable|integer|min:1',

            'bahan_lantai'
                => 'nullable|integer',

            'bahan_dinding'
                => 'nullable|integer',

            'bahan_atap'
                => 'nullable|integer',

            'fasilitas_bab'
                => 'nullable|integer',

            'jenis_kloset'
                => 'nullable|integer',

            'pembuangan_tinja'
                => 'nullable|integer',

            'sumber_air_minum'
                => 'nullable|integer',

            'sumber_penerangan'
                => 'nullable|integer',

            'meterans'
                => 'nullable|array',

            'meterans.*.daya_listrik'
                => 'required_with:meterans|integer',

            'kredit_sumber'
                => 'nullable|array',

            'kredit_sumber.*'
                => 'string',

            'kredit_tujuan'
                => 'nullable|array',

            'kredit_tujuan.*'
                => 'string',

            'latitude_rumah'
                => 'nullable|numeric|between:-90,90',

            'longitude_rumah'
                => 'nullable|numeric|between:-180,180',

            'akurasi_rumah'
                => 'nullable|numeric|min:0',
        ],
        
        [],

        [

            'nama_kepala_keluarga'
                => '2a. Nama Kepala Keluarga',

            'nik_kepala_keluarga'
                => '2b. NIK Kepala Keluarga',

            'nomor_kk'
                => '2c. Nomor Kartu Keluarga (KK)',

            'provinsi'
                => '3a. Provinsi',

            'kabupaten'
                => '3b. Kabupaten/Kota',

            'kecamatan'
                => '3c. Kecamatan',

            'desa'
                => '3d. Desa/Kelurahan',

            'dusun'
                => '3e. Dusun',

            'alamat_detail'
                => '3f. Alamat Detail',

            'alamat_sesuai_kk'
                => '4. Kesesuaian Alamat dengan KK',

            'jumlah_keluarga_dalam_rumah'
                => '20. Jumlah Keluarga dalam Rumah',

            'status_kepemilikan_rumah'
                => '21. Status Kepemilikan Rumah',

            'luas_lantai'
                => '22. Luas Lantai',

            'bahan_lantai'
                => '23. Bahan Lantai',

            'bahan_dinding'
                => '24. Bahan Dinding',

            'bahan_atap'
                => '25. Bahan Atap',

            'fasilitas_bab'
                => '26. Fasilitas BAB',

            'jenis_kloset'
                => '27. Jenis Kloset',

            'pembuangan_tinja'
                => '28. Pembuangan Akhir Tinja',

            'sumber_air_minum'
                => '29. Sumber Air Minum',

            'sumber_penerangan'
                => '30. Sumber Penerangan',

            'meterans.*.daya_listrik'
                => '31b. Daya Listrik Meteran',

        ]);
    }
}