<?php

namespace App\Constants\AnggotaKeluarga;

class PartisipasiSekolah
{
    public const BELUM = 0;
    public const MASIH = 1;
    public const TIDAK = 2;

    public const OPTIONS = [
        self::BELUM => '0. Tidak/belum pernah sekolah',
        self::MASIH => '1. Masih Sekolah',
        self::TIDAK => '2. Tidak Bersekolah Lagi',
    ];
}