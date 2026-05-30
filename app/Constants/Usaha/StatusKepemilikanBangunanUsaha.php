<?php

namespace App\Constants\Usaha;

class StatusKepemilikanBangunanUsaha
{
    public const SENDIRI = 1;
    public const KONTRAK = 2;
    public const BEBAS_SEWA = 3;
    public const LAINNYA = 4;

    public const OPTIONS = [
        self::SENDIRI => 'Milik Sendiri',
        self::KONTRAK => 'Kontrak/Sewa',
        self::BEBAS_SEWA => 'Bebas Sewa',
        self::LAINNYA => 'Lainnya',
    ];
}