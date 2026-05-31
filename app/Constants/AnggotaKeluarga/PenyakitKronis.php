<?php

namespace App\Constants\AnggotaKeluarga;

class PenyakitKronis
{
    public const HIPERTENSI = 'A';
    public const REMATIK = 'B';
    public const ASMA = 'C';
    public const JANTUNG = 'D';
    public const DIABETES = 'E';
    public const TUBERKULOSIS = 'F';
    public const STROKE = 'G';
    public const KANKER = 'H';
    public const GINJAL = 'I';
    public const HEMOFILIA = 'J';
    public const HIV_AIDS = 'K';
    public const KOLESTEROL = 'L';
    public const SIROSIS = 'M';
    public const TALASEMIA = 'N';
    public const LEUKIMIA = 'O';
    public const ALZHEIMER = 'P';
    public const LAINNYA = 'Q';
    public const TIDAK_ADA = 'X';

    public const OPTIONS = [
        self::HIPERTENSI => 'Hipertensi',
        self::REMATIK => 'Rematik',
        self::ASMA => 'Asma',
        self::JANTUNG => 'Masalah jantung',
        self::DIABETES => 'Diabetes',
        self::TUBERKULOSIS => 'Tuberkulosis',
        self::STROKE => 'Stroke',
        self::KANKER => 'Kanker atau tumor ganas',
        self::GINJAL => 'Gagal ginjal',
        self::HEMOFILIA => 'Hemofilia',
        self::HIV_AIDS => 'HIV/AIDS',
        self::KOLESTEROL => 'Kolesterol',
        self::SIROSIS => 'Sirosis',
        self::TALASEMIA => 'Talasemia',
        self::LEUKIMIA => 'Leukimia',
        self::ALZHEIMER => 'Alzheimer',
        self::LAINNYA => 'Lainnya',
        self::TIDAK_ADA => 'Tidak Memiliki Keterbatasan',
    ];
}