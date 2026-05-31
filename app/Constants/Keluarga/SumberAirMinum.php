<?php

namespace App\Constants\Keluarga;

class SumberAirMinum
{
    public const KEMASAN = 1;
    public const ISI_ULANG = 2;
    public const LEDING = 3;
    public const SUMUR_BOR = 4;
    public const SUMUR_TERLINDUNG = 5;
    public const SUMUR__TAK_TERLINDUNG = 6;
    public const MATA_AIR_TERLINDUNG = 7;
    public const MATA_AIR_TAK_TERLINDUNG = 8;
    public const AIR_PERMUKAAN = 9;
    public const AIR_HUJAN = 10;
    public const LAINNYA = 11;

    public const OPTIONS = [
        self::KEMASAN => '1. Air Kemasan bermerk',
        self::ISI_ULANG => '2. Air Isi Ulang',
        self::LEDING => '3. Leding',
        self::SUMUR_BOR => '4. Sumur bor/pompa',
        self::SUMUR_TERLINDUNG => '5. Sumur Terlindung',
        self::SUMUR__TAK_TERLINDUNG => '6. Sumur Tak Terlindung',
        self::MATA_AIR_TERLINDUNG => '7. Mata Air Terlindung',
        self::MATA_AIR_TAK_TERLINDUNG => '8. Mata Air Tak Terlindung',
        self::AIR_PERMUKAAN => '9. Air Permukaan (sungai/danau/waduk/kolam/irigasi)',
        self::AIR_HUJAN => '10. Air Hujan',
        self::LAINNYA => '11. Lainnya',
    ];
}