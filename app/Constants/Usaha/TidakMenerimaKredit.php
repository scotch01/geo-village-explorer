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

        self::PROSEDUR_SULIT => 'Prosedur sulit ',
        self::JAMINAN => 'Tidak ada jaminan',
        self::TIDAK_TAHU_PROSEDUR => 'Tidak tahu prosedur pinjaman',
        self::TIDAK_PERLU => 'Tidak memerlukan pinjaman',
        self::LAINNYA => 'Lainnya',
        self::TIDAK_RELEVAN => 'Tidak relevan',

    ];
}