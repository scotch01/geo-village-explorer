<?php

namespace App\Constants\Tempat;

class JenisBangunan
{
    public const BTT = 'btt';
    public const BKU = 'bku';
    public const BC  = 'bc';

    public const OPTIONS = [
        self::BTT => '1. Bangunan Tempat Tinggal (BTT)',
        self::BKU => '2. Bangunan Khusus Usaha (BKU)',
        self::BC  => '3. Bangunan Campuran (BC)',
    ];
}