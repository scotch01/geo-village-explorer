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
        self::KEPALA => '1. Kepala keluarga',
        self::ISTRI_SUAMI => '2. Istri/Suami',
        self::ANAK => '3. Anak',
        self::MENANTU => '4. Menantu',
        self::CUCU => '5. Cucu',
        self::ORANG_TUA => '6. Orang Tua',
        self::MERTUA => '7. Mertua',
        self::FAMILI_LAIN => '8. Famili Lain',
        self::LAINNYA => '9. Lainnya',
    ];
}