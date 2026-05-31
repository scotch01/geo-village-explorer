<?php

namespace App\Constants\Shared;

class JenisKelamin
{
    public const LAKI_LAKI = 1;
    public const PEREMPUAN = 2;

    public const OPTIONS = [
        self::LAKI_LAKI => '1. Laki-Laki',
        self::PEREMPUAN => '2. Perempuan',
    ];
}