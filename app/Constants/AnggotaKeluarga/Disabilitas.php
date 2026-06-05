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
        self::FISIK => 'A. Disabilitas Fisik',
        self::MENTAL => 'B. Disabilitas Mental',
        self::INTELEKTUAL => 'C. Disabilitas Intelektual',
        self::SENSORIK_NETRA => 'D. Disabilitas Sensorik - Netra',
        self::SENSORIK_RUNGU => 'E. Disabilitas Sensorik - Rungu',
        self::SENSORIK_WICARA => 'F. Disabilitas Sensorik - Wicara',
        self::TIDAK_ADA => 'X. Tidak Ada',
    ];
}