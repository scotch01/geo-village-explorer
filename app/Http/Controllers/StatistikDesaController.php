<?php

namespace App\Http\Controllers;

use App\Constants\Tempat\JenisBangunan;
use App\Models\AnggotaKeluarga;
use App\Models\Desa;
use App\Models\Keluarga;
use App\Models\Tempat;
use App\Models\Usaha;

class StatistikDesaController extends Controller
{
    /**
     * Ringkasan statistik desa: total kepala keluarga, usaha, dan penduduk,
     * beserta rincian per desa untuk ditampilkan saat hover.
     */
    public function summary(): array
    {
        $perDesaKeluarga = Keluarga::query()
            ->join('tempats', 'tempats.id', '=', 'keluargas.tempat_id')
            ->join('desas', 'desas.id', '=', 'tempats.id_desa')
            ->selectRaw('desas.nama_desa, COUNT(*) as total')
            ->groupBy('desas.id', 'desas.nama_desa')
            ->orderByDesc('total')
            ->get();

        $perDesaUsaha = Usaha::query()
            ->join('tempats', 'tempats.id', '=', 'usahas.tempat_id')
            ->join('desas', 'desas.id', '=', 'tempats.id_desa')
            ->selectRaw('desas.nama_desa, COUNT(*) as total')
            ->groupBy('desas.id', 'desas.nama_desa')
            ->orderByDesc('total')
            ->get();

        $perDesaPenduduk = AnggotaKeluarga::query()
            ->join('keluargas', 'keluargas.id', '=', 'anggota_keluargas.keluarga_id')
            ->join('tempats', 'tempats.id', '=', 'keluargas.tempat_id')
            ->join('desas', 'desas.id', '=', 'tempats.id_desa')
            ->selectRaw('desas.nama_desa, COUNT(*) as total')
            ->groupBy('desas.id', 'desas.nama_desa')
            ->orderByDesc('total')
            ->get();

        /**
         * JENIS BANGUNAN (dari tabel tempats, 4 kategori: BTT, BKU, BC, BL)
         */
        $totalPerJenisBangunan = Tempat::query()
            ->selectRaw('jenis_bangunan, COUNT(*) as total')
            ->groupBy('jenis_bangunan')
            ->pluck('total', 'jenis_bangunan');

        $perDesaJenisBangunan = [];

        foreach (JenisBangunan::OPTIONS as $kode => $label) {

            $perDesaJenisBangunan[$kode] = Tempat::query()
                ->join('desas', 'desas.id', '=', 'tempats.id_desa')
                ->where('tempats.jenis_bangunan', $kode)
                ->selectRaw('desas.nama_desa, COUNT(*) as total')
                ->groupBy('desas.id', 'desas.nama_desa')
                ->orderByDesc('total')
                ->get();
        }

        $jenisBangunan = collect(JenisBangunan::OPTIONS)
            ->map(function ($label, $kode) use ($totalPerJenisBangunan, $perDesaJenisBangunan) {

                return [
                    'kode' => $kode,
                    'label' => $label,
                    'total' => (int) ($totalPerJenisBangunan[$kode] ?? 0),
                    'perDesa' => $perDesaJenisBangunan[$kode],
                ];
            })
            ->values();

        return [
            'totalKeluarga' => Keluarga::count(),
            'totalUsaha' => Usaha::count(),
            'totalPenduduk' => AnggotaKeluarga::count(),
            'perDesaKeluarga' => $perDesaKeluarga,
            'perDesaUsaha' => $perDesaUsaha,
            'perDesaPenduduk' => $perDesaPenduduk,
            'jenisBangunan' => $jenisBangunan,
        ];
    }
}
