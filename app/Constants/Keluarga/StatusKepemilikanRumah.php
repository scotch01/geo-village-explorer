<?php

namespace App\Constants\Keluarga;

class StatusKepemilikanRumah
{
    public const SENDIRI = 1;
    public const KONTRAK = 2;
    public const BEBAS_SEWA = 3;
    public const DINAS = 4;
    public const LAINNYA = 5;

    public const OPTIONS = [
        self::SENDIRI => '1. Milik Sendiri',
        self::KONTRAK => '2. Kontrak/Sewa',
        self::BEBAS_SEWA => '3. Bebas Sewa',
        self::DINAS => '4. Dinas',
        self::LAINNYA => '5. Lainnya',
    ];
}