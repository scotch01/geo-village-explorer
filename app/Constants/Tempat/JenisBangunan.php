<?php

namespace App\Constants\Tempat;

class JenisBangunan
{
    public const BTT = 'btt';
    public const BKU = 'bku';
    public const BC  = 'bc';

    public const OPTIONS = [
        self::BTT => '1. Bangunan Tempat Tinggal',
        self::BKU => '2. Bangunan Khusus Usaha',
        self::BC  => '3. Bangunan Campuran',
    ];
}