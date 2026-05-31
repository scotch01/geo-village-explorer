<?php

namespace App\Constants\Keluarga;

class BahanDinding
{
    public const TEMBOK = 1;
    public const KAWAT = 2;
    public const PAPAN = 3;
    public const ANYAMAN_BAMBU = 4;
    public const KAYU = 5;
    public const BAMBU = 6;
    public const LAINNYA = 7;

    public const OPTIONS = [
        self::TEMBOK => 'Tembok',
        self::KAWAT => 'Plesteran Anyaman Bambu/Kawat',
        self::PAPAN => 'Kayu/Papan/Gipsum/GRC/Calciboard',
        self::ANYAMAN_BAMBU => 'Anyaman Bambu',
        self::KAYU => 'Batang Kayu',
        self::BAMBU => 'Bambu',
        self::LAINNYA => 'Lainnya',
    ];
}