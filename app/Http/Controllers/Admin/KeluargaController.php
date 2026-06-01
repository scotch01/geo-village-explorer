<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use App\Models\Keluarga;
use Illuminate\Http\Request;

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

class KeluargaController extends Controller
{
    public function create(Tempat $tempat)
    {
        $desa = auth()->user()->desa;

        return view(
            'admin.keluarga.create',
            [
                'tempat' => $tempat,

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

        $validated = $this->validateData($request);

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
                'admin.tempat.survey',
                $tempat
            )
            ->with(
                'success',
                'Data keluarga berhasil disimpan'
            );
    }

    public function edit(
        Tempat $tempat
    )
    {
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
            ]
        );
    }

    public function update(
        Request $request,
        Tempat $tempat
    )
    {
        $keluarga =
            $tempat->keluarga;

        if (!$keluarga) {
            abort(404);
        }

        $validated =
            $this->validateData($request);

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
                'admin.tempat.survey',
                $tempat
            )
            ->with(
                'success',
                'Data keluarga berhasil diperbarui'
            );
    }

    public function destroy(
        Tempat $tempat
    )
    {
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
                'success',
                'Data keluarga berhasil dihapus'
            );
    }

    private function validateData(Request $request)
    {
        return $request->validate([

            'nama_kepala_keluarga'
                => 'required|string|max:255',

            'nik_kepala_keluarga'
                => 'required|string|max:16',

            'nomor_kk'
                => 'required|string|max:16',

            'provinsi'
                => 'required|string|max:255',

            'kabupaten'
                => 'required|string|max:255',

            'kecamatan'
                => 'required|string|max:255',

            'desa'
                => 'required|string|max:255',
            
            'dusun'
                => 'nullable|string|max:255',

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
        ]);
    }
}