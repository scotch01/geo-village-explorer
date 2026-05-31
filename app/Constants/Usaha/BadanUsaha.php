<?php

namespace App\Constants\Usaha;

class BadanUsaha
{
    public const PT = 1;
    public const CV = 2;
    public const YAYASAN = 3;
    public const LAINNYA = 4;
    public const TIDAK = 5;

    public const OPTIONS = [
        self::PT => '1. PT/perseroan/perum ',
        self::CV => '2. Commanditaire Vennootschap (CV)',
        self::YAYASAN => '3. Yayasan',
        self::LAINNYA => '4. Lainnya',
        self::TIDAK => '5. Tidak Berbadan Hukum',
    ];
}