<?php

namespace App\Constants\AnggotaKeluarga;

class HubunganKeluarga
{
    public const KEPALA = 1;
    public const ISTRI_SUAMI = 2;
    public const ANAK = 3;
    public const MENANTU = 4;
    public const CUCU = 5;
    public const ORANG_TUA = 6;
    public const MERTUA = 7;
    public const FAMILI_LAIN = 8;
    public const LAINNYA = 9;

    public const OPTIONS = [
        self::KEPALA => 'Kepala keluarga',
        self::ISTRI_SUAMI => 'Istri/Suami',
        self::ANAK => 'Anak',
        self::MENANTU => 'Menantu',
        self::CUCU => 'Cucu',
        self::ORANG_TUA => 'Orang Tua',
        self::MERTUA => 'Mertua',
        self::FAMILI_LAIN => 'Famili Lain',
        self::LAINNYA => 'Lainnya',
    ];
}