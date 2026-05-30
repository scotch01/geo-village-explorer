<?php

namespace App\Constants\Keluarga;

class DayaListrik
{
    public const DAYA_450 = 1;
    public const DAYA_900 = 2;
    public const DAYA_1300 = 3;
    public const DAYA_2200 = 4;
    public const DAYA_2200_PLUS = 5;

    public const OPTIONS = [
        self::DAYA_450 => '450',
        self::DAYA_900 => '900',
        self::DAYA_1300 => '1300',
        self::DAYA_2200 => '2200',
        self::DAYA_2200_PLUS => '>2200',
    ];
}