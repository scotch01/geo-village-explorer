<?php

namespace App\Constants\Tempat;

class JenisBangunan
{
    public const BTT = 'btt';
    public const BKU = 'bku';
    public const BC  = 'bc';

    public const OPTIONS = [
        self::BTT => 'Bangunan Tempat Tinggal',
        self::BKU => 'Bangunan Khusus Usaha',
        self::BC  => 'Bangunan Campuran',
    ];
}