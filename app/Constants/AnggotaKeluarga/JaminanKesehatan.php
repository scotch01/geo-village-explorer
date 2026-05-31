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
        self::PBI => 'BPJS Kesehatan Penerima Bantuan Iuran (PBI)',
        self::NON_PBI => 'BPJS Kesehatan Non-PBI/Mandiri',
        self::JAMKESDA => 'Jamkesda',
        self::SWASTA => 'Asuransi Swasta',
        self::KANTOR => 'Perusahaan/Kantor',
        self::TIDAK_ADA => 'Tidak Ada',
    ];
}