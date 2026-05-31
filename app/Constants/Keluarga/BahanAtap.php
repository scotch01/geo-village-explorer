<?php

namespace App\Constants\Keluarga;

class BahanAtap
{
    public const BETON = 1;
    public const GENTENG = 2;
    public const SENG = 3;
    public const ASBES = 4;
    public const BAMBU = 5;
    public const KAYU = 6;
    public const JERAMI = 7;
    public const LAINNYA = 8;

    public const OPTIONS = [
        self::BETON => '1. Beton',
        self::GENTENG => '2. Genteng',
        self::SENG => '3. Seng',
        self::ASBES => '4. Asbes',
        self::BAMBU => '5. Bambu',
        self::KAYU => '6. Kayu/Sirap',
        self::JERAMI => '7. Jerami/Ijuk/Daun-daunan/Rumbia',
        self::LAINNYA => '8. Lainnya',
    ];
}