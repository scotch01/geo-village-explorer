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

class KeluargaController extends Controller
{
    public function create(Tempat $tempat)
    {
        return view(
            'admin.keluarga.create',
            [
                'tempat' => $tempat,

                'statusKepemilikanRumah'
                    => StatusKepemilikanRumah::OPTIONS,

                'bahanLantai'
                    => BahanLantai::OPTIONS,

                'bahanDinding'
                    => BahanDinding::OPTIONS,

                'bahanAtap'
                    => BahanAtap::OPTIONS,

                'fasilitasBAB'
                    => FasilitasBAB::OPTIONS,

                'jenisKloset'
                    => JenisKloset::OPTIONS,

                'pembuanganTinja'
                    => PembuanganTinja::OPTIONS,

                'sumberAirMinum'
                    => SumberAirMinum::OPTIONS,

                'sumberPenerangan'
                    => SumberPenerangan::OPTIONS,
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

        $validated =
            $this->validateData($request);

        $validated['tempat_id']
            = $tempat->id;

        Keluarga::create($validated);

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
        $keluarga =
            $tempat->keluarga;

        if (!$keluarga) {
            abort(404);
        }

        return view(
            'admin.keluarga.edit',
            compact(
                'tempat',
                'keluarga'
            )
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

        $keluarga->update(
            $validated
        );

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
                => 'required|string|max:20',

            'provinsi'
                => 'required|string|max:255',

            'kabupaten'
                => 'required|string|max:255',

            'kecamatan'
                => 'required|string|max:255',

            'desa'
                => 'required|string|max:255',
            
            'dusun'
                => 'required|string|max:255',

            'alamat_detail'
                => 'required|string',
        ]);
    }
}