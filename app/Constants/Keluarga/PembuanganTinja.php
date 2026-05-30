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
        self::SEPTIK => 'Tangki Septik',
        self::IPAL => 'Instalasi Pengolahan Air Limbah (IPAL)',
        self::KOLAM => 'Kolam/sawah/sungai/danau/laut',
        self::LUBANG => 'Lubang tanah',
        self::KEBUN => 'Pantai/tanah lapang/kebun',
        self::LAINNYA => 'Lainnya',
    ];
}