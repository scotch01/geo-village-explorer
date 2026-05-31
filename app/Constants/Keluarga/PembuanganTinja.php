<?php

namespace App\Constants\Keluarga;

class PembuanganTinja
{
    public const SEPTIK = 1;
    public const IPAL = 2;
    public const KOLAM = 3;
    public const LUBANG = 4;
    public const KEBUN = 5;
    public const LAINNYA = 6;

    public const OPTIONS = [
        self::SEPTIK => '1. Tangki Septik',
        self::IPAL => '2. Instalasi Pengolahan Air Limbah (IPAL)',
        self::KOLAM => '3. Kolam/sawah/sungai/danau/laut',
        self::LUBANG => '4. Lubang tanah',
        self::KEBUN => '5. Pantai/tanah lapang/kebun',
        self::LAINNYA => '6. Lainnya',
    ];
}