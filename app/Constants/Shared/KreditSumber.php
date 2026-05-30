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

        self::BANK => 'Bank',
        self::KOPERASI => 'Koperasi',
        self::PINJAMAN_ONLINE => 'Pinjaman Online',
        self::PERORANGAN_KELUARGA => 'Perorangan/Keluarga',
        self::PNM_MEKAAR => 'PNM Mekaar',
        self::LAINNYA => 'Lainnya',
        self::TIDAK_ADA => 'Tidak Menerima Pinjaman',
    ];
}