<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Seed data desa target Kecamatan Pariaman Selatan.
     */
    public function run(): void
    {
        $desas = [
            [
                'nama_desa' => 'Sungai Kasai',
                'kode_desa' => '001',
                'kecamatan' => 'Pariaman Selatan',
                'kabupaten' => 'Kota Pariaman',
                'provinsi' => 'Sumatera Barat',
            ],
            [
                'nama_desa' => 'Pasir Sunur',
                'kode_desa' => '002',
                'kecamatan' => 'Pariaman Selatan',
                'kabupaten' => 'Kota Pariaman',
                'provinsi' => 'Sumatera Barat',
            ],
            [
                'nama_desa' => 'Kampung Apar',
                'kode_desa' => '003',
                'kecamatan' => 'Pariaman Selatan',
                'kabupaten' => 'Kota Pariaman',
                'provinsi' => 'Sumatera Barat',
            ],
        ];

        foreach ($desas as $desa) {
            Desa::updateOrCreate(
                ['kode_desa' => $desa['kode_desa']],
                $desa
            );
        }
    }
}
