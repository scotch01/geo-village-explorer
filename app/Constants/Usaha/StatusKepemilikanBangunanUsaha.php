<?php

namespace App\Constants\Usaha;

class StatusKepemilikanBangunanUsaha
{
    public const SENDIRI = 1;
    public const KONTRAK = 2;
    public const BEBAS_SEWA = 3;
    public const LAINNYA = 4;

    public const OPTIONS = [
        self::SENDIRI => '1. Milik Sendiri',
        self::KONTRAK => '2. Kontrak/Sewa',
        self::BEBAS_SEWA => '3. Bebas Sewa',
        self::LAINNYA => '4. Lainnya',
    ];
}