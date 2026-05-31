<?php

namespace App\Constants\Keluarga;

class BahanLantai
{
    public const MARMER = 1;
    public const KERAMIK = 2;
    public const PARKET = 3;
    public const UBIN = 4;
    public const KAYU = 5;
    public const SEMEN = 6;
    public const BAMBU = 7;
    public const TANAH = 8;
    public const LAINNYA = 9;

    public const OPTIONS = [
        self::MARMER => '1. Marmer/Granit',
        self::KERAMIK => '2. Keramik',
        self::PARKET => '3. Parket/Vinyl/Karpet',
        self::UBIN => '4. Ubin/Tegel/Teraso',
        self::KAYU => '5. Kayu/Papan',
        self::SEMEN => '6. Semen/Bata Merah',
        self::BAMBU => '7. Bambu',
        self::TANAH => '8. Tanah',
        self::LAINNYA => '9. Lainnya',
    ];
}