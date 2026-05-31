<?php

namespace App\Constants\AnggotaKeluarga;

class Disabilitas
{
    public const FISIK = 'A';
    public const MENTAL = 'B';
    public const INTELEKTUAL = 'C';
    public const SENSORIK_NETRA = 'D';
    public const SENSORIK_RUNGU = 'E';
    public const SENSORIK_WICARA = 'F';
    public const TIDAK_ADA = 'X';

    public const OPTIONS = [
        self::FISIK => 'Disabilitas Fisik',
        self::MENTAL => 'Disabilitas Mental',
        self::INTELEKTUAL => 'Disabilitas Intelektual',
        self::SENSORIK_NETRA => 'Disabilitas Sensorik - Netra',
        self::SENSORIK_RUNGU => 'Disabilitas Sensorik - Rungu',
        self::SENSORIK_WICARA => 'Disabilitas Sensorik - Wicara',
        self::TIDAK_ADA => 'Tidak Ada',
    ];
}