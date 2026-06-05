<?php

namespace App\Constants\AnggotaKeluarga;

class StatusPerkawinan
{
    public const BELUM = 1;
    public const KAWIN = 2;
    public const CERAI_HIDUP = 3;
    public const CERAI_MATI = 4;

    public const OPTIONS = [
        self::BELUM => '1. Belum Kawin',
        self::KAWIN => '2. Kawin',
        self::CERAI_HIDUP => '3. Cerai Hidup',
        self::CERAI_MATI => '4. Cerai Mati',
    ];
}