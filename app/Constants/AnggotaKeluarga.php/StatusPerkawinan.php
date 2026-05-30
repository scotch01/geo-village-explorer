<?php

namespace App\Constants\AnggotaKeluarga;

class StatusPerkawinan
{
    public const BELUM = 1;
    public const KAWIN = 2;
    public const CERAI_HIDUP = 3;
    public const CERAI_MATI = 4;

    public const OPTIONS = [
        self::BELUM => 'Belum Kawin',
        self::KAWIN => 'Kawin',
        self::CERAI_HIDUP => 'Cerai Hidup',
        self::CERAI_MATI => 'Cerai Mati',
    ];
}