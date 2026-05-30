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
        self::SENDIRI => 'Milik Sendiri',
        self::KONTRAK => 'Kontrak/Sewa',
        self::BEBAS_SEWA => 'Bebas Sewa',
        self::DINAS => 'Dinas',
        self::LAINNYA => 'Lainnya',
    ];
}