<?php

namespace App\Constants\Keluarga;

class SumberPenerangan
{
    public const PLN_METERAN = 1;
    public const PLN_NON_METERAN = 2;
    public const NON_PLN = 3;
    public const BUKAN_LISTRIK = 4;

    public const OPTIONS = [
        self::PLN_METERAN => 'Listrik PLN dengan meteran',
        self::PLN_NON_METERAN => 'Listrik PLN tanpa meteran',
        self::NON_PLN => 'Listrik non-PLN',
        self::BUKAN_LISTRIK => 'Bukan listrik',
    ];
}