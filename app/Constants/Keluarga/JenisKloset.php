<?php

namespace App\Constants\Keluarga;

class JenisKloset
{
    public const ANGSA = 1;
    public const TUTUP = 2;
    public const TANPA_TUTUP = 3;
    public const CEMPLUNG = 4;

    public const OPTIONS = [
        self::ANGSA => '1. Leher Angsa',
        self::TUTUP => '2. Plengsengan dengan tutup',
        self::TANPA_TUTUP => '3. Plengsengan tanpa tutup',
        self::CEMPLUNG => '4. Cemplung/cubluk',
    ];
}