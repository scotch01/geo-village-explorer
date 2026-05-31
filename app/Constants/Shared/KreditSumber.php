<?php

namespace App\Constants\Shared;

class KreditSumber
{
    public const BANK = 'A';
    public const KOPERASI = 'B';
    public const PINJAMAN_ONLINE = 'C';
    public const PERORANGAN_KELUARGA = 'D';
    public const PNM_MEKAAR = 'E';
    public const LAINNYA = 'F';
    public const TIDAK_ADA = 'X';

    public const OPTIONS = [

        self::BANK => 'A. Bank',
        self::KOPERASI => 'B. Koperasi',
        self::PINJAMAN_ONLINE => 'C. Pinjaman Online',
        self::PERORANGAN_KELUARGA => 'D. Perorangan/Keluarga',
        self::PNM_MEKAAR => 'E. PNM Mekaar',
        self::LAINNYA => 'F. Lainnya',
        self::TIDAK_ADA => 'X. Tidak Menerima Pinjaman',
    ];
}