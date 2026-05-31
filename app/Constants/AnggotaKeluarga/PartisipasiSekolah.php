<?php

namespace App\Constants\AnggotaKeluarga;

class PartisipasiSekolah
{
    public const BELUM = 0;
    public const MASIH = 1;
    public const TIDAK = 2;

    public const OPTIONS = [
        self::BELUM => 'Tidak/belum pernah sekolah',
        self::MASIH => 'Masih Sekolah',
        self::TIDAK => 'Tidak Bersekolah Lagi',
    ];
}