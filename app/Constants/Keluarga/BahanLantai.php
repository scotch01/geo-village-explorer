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
        self::MARMER => 'Marmer/Granit',
        self::KERAMIK => 'Keramik',
        self::PARKET => 'Parket/Vinyl/Karpet',
        self::UBIN => 'Ubin/Tegel/Teraso',
        self::KAYU => 'Kayu/Papan',
        self::SEMEN => 'Semen/Bata Merah',
        self::BAMBU => 'Bambu',
        self::TANAH => 'Tanah',
        self::LAINNYA => 'Lainnya',
    ];
}