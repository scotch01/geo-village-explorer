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
        self::KEMASAN => 'Air Kemasan bermerk',
        self::ISI_ULANG => 'Air Isi Ulang',
        self::LEDING => 'Leding',
        self::SUMUR_BOR => 'Sumur bor/pompa',
        self::SUMUR_TERLINDUNG => 'Sumur Terlindung',
        self::SUMUR__TAK_TERLINDUNG => 'Sumur Tak Terlindung',
        self::MATA_AIR_TERLINDUNG => 'Mata Air Terlindung',
        self::MATA_AIR_TAK_TERLINDUNG => 'Mata Air Tak Terlindung',
        self::AIR_PERMUKAAN => 'Air Permukaan (sungai/danau/waduk/kolam/irigasi)',
        self::AIR_HUJAN => 'Air Hujan',
        self::LAINNYA => 'Lainnya',
    ];
}