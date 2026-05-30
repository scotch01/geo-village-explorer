<?php

namespace App\Constants\AnggotaKeluarga;

class RekeningAktif
{
    public const UNTUK_USAHA = 1;
    public const UNTUK_PRIBADI = 2;
    public const UNTUK_USAHA_DAN_PRIBADI = 3;
    public const TIDAK_ADA = 4;
    public const TIDAK_TAHU = 0;

    public const OPTIONS = [
        self::UNTUK_USAHA => 'Ya, Untuk Usaha',
        self::UNTUK_PRIBADI => 'Ya, Untuk Pribadi',
        self::UNTUK_USAHA_DAN_PRIBADI => 'Ya, Untuk Usaha dan Pribadi',
        self::TIDAK_ADA => 'Tidak Ada',
        self::TIDAK_TAHU => 'Tidak Tahu',
    ];
}