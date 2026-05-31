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
        self::TEMBOK => '1. Tembok',
        self::KAWAT => '2. Plesteran Anyaman Bambu/Kawat',
        self::PAPAN => '3. Kayu/Papan/Gipsum/GRC/Calciboard',
        self::ANYAMAN_BAMBU => '4. Anyaman Bambu',
        self::KAYU => '5. Batang Kayu',
        self::BAMBU => '6. Bambu',
        self::LAINNYA => '7. Lainnya',
    ];
}