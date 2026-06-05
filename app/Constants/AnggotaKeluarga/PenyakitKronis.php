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
        self::HIPERTENSI => 'A. Hipertensi',
        self::REMATIK => 'B. Rematik',
        self::ASMA => 'C. Asma',
        self::JANTUNG => 'D. Masalah jantung',
        self::DIABETES => 'E. Diabetes',
        self::TUBERKULOSIS => 'F. Tuberkulosis',
        self::STROKE => 'G. Stroke',
        self::KANKER => 'H. Kanker atau tumor ganas',
        self::GINJAL => 'I. Gagal ginjal',
        self::HEMOFILIA => 'J. Hemofilia',
        self::HIV_AIDS => 'K. HIV/AIDS',
        self::KOLESTEROL => 'L. Kolesterol',
        self::SIROSIS => 'M. Sirosis',
        self::TALASEMIA => 'N. Talasemia',
        self::LEUKIMIA => 'O. Leukimia',
        self::ALZHEIMER => 'P. Alzheimer',
        self::LAINNYA => 'Q. Lainnya',
        self::TIDAK_ADA => 'X. Tidak Memiliki Keterbatasan',
    ];
}