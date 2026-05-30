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
        self::PT => 'PT/perseroan/perum ',
        self::CV => 'Commanditaire Vennootschap (CV)',
        self::YAYASAN => 'Yayasan',
        self::LAINNYA => 'Lainnya',
        self::TIDAK => 'Tidak Berbadan Hukum',
    ];
}