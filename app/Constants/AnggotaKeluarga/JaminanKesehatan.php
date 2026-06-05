<?php

namespace App\Constants\AnggotaKeluarga;

class JaminanKesehatan
{
    public const PBI = 'A';
    public const NON_PBI = 'B';
    public const JAMKESDA = 'C';
    public const SWASTA = 'D';
    public const KANTOR = 'E';
    public const TIDAK_ADA = 'X';

    public const OPTIONS = [
        self::PBI => 'A. BPJS Kesehatan Penerima Bantuan Iuran (PBI)',
        self::NON_PBI => 'B. BPJS Kesehatan Non-PBI/Mandiri',
        self::JAMKESDA => 'C. Jamkesda',
        self::SWASTA => 'D. Asuransi Swasta',
        self::KANTOR => 'E. Perusahaan/Kantor',
        self::TIDAK_ADA => 'X. Tidak Ada',
    ];
}