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
        self::BETON => 'Beton',
        self::GENTENG => 'Genteng',
        self::SENG => 'Seng',
        self::ASBES => 'Asbes',
        self::BAMBU => 'Bambu',
        self::KAYU => 'Kayu/Sirap',
        self::JERAMI => 'Jerami/Ijuk/Daun-daunan/Rumbia',
        self::LAINNYA => 'Lainnya',
    ];
}