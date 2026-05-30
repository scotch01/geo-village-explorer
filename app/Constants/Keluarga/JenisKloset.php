<?php

namespace App\Constants\Keluarga;

class JenisKloset
{
    public const ANGSA = 1;
    public const TUTUP = 2;
    public const TANPA_TUTUP = 3;
    public const CEMPLUNG = 4;

    public const OPTIONS = [
        self::ANGSA => 'Leher Angsa',
        self::TUTUP => 'Plengsengan dengan tutup',
        self::TANPA_TUTUP => 'Plengsengan tanpa tutup',
        self::CEMPLUNG => 'Cemplung/cubluk',
    ];
}