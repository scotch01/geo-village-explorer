<?php

namespace App\Constants\Usaha;

class TidakMenerimaKredit
{
    public const PROSEDUR_SULIT = 1;
    public const JAMINAN = 2;
    public const TIDAK_TAHU_PROSEDUR = 3;
    public const TIDAK_PERLU = 4;
    public const LAINNYA = 5;
    public const TIDAK_RELEVAN = 0;

    public const OPTIONS = [

        self::PROSEDUR_SULIT => '1. Prosedur sulit ',
        self::JAMINAN => '2. Tidak ada jaminan',
        self::TIDAK_TAHU_PROSEDUR => '3. Tidak tahu prosedur pinjaman',
        self::TIDAK_PERLU => '4. Tidak memerlukan pinjaman',
        self::LAINNYA => '5. Lainnya',
        self::TIDAK_RELEVAN => '0. Tidak relevan',

    ];
}