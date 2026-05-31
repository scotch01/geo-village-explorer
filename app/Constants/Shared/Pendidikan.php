<?php

namespace App\Constants\Shared;

class Pendidikan
{
    public const TIDAK = 0;
    public const SD = 1;
    public const SMP = 2;
    public const SMA = 3;
    public const DIPLOMA = 4;
    public const S1 = 5;
    public const S2_S3 = 6;

    public const OPTIONS = [
        self::TIDAK => '0. Tidak punya ijazah SD',
        self::SD => '1. SD/Sederajat',
        self::SMP => '2. SMP/Sederajat',
        self::SMA => '3. SMA/Sederajat',
        self::DIPLOMA => '4. Diploma I/II/III',
        self::S1 => '5. Diploma IV/S1/Profesi',
        self::S2_S3 => '6. S2/S3'
    ];
}