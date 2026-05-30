<?php

namespace App\Constants\Keluarga;

class FasilitasBAB
{
    public const SATU_RUMAH = 1;
    public const BANYAK_RUMAH = 2;
    public const KOMUNAL = 3;
    public const UMUM = 4;
    public const TIDAK_MENGGUNAKAN = 5;
    public const TIDAK_ADA = 6;

    public const OPTIONS = [
        self::SATU_RUMAH => 'Ada, digunakan oleh anggota keluarga dalam satu rumah',
        self::BANYAK_RUMAH => 'Ada, digunakan bersama oleh anggota keluarga dari beberapa rumah',
        self::KOMUNAL => 'Ada, di MCK komunal',
        self::UMUM => 'Ada, di MCK umum/siapapun menggunakan',
        self::TIDAK_MENGGUNAKAN => 'Ada, anggota keluarga tidak menggunakan',
        self::TIDAK_ADA => 'Tidak Ada',
    ];
}