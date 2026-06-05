<?php

namespace App\Constants\AnggotaKeluarga;

class KedudukanPekerjaan
{
    public const USAHA_SENDIRI = 1;
    public const USAHA_BURUH = 2;
    public const BURUH = 3;
    public const ASN = 4;
    public const PEKERJA_BEBAS = 5;
    public const PEKERJA_KELUARGA = 6;
    public const TIDAK_TAHU = 0;

    public const OPTIONS = [
        self::USAHA_SENDIRI => '1. Berusaha sendiri',
        self::USAHA_BURUH => '2. Berusaha dibantu buruh',
        self::BURUH => '3. Buruh/karyawan/pegawai swasta',
        self::ASN => '4. ASN/TNI/Polri/BUMN/BUMD/Pejabat Negara/Kades',
        self::PEKERJA_BEBAS => '5. Pekerja Bebas',
        self::PEKERJA_KELUARGA => '6. Pekerja keluarga/tidak dibayar',
        self::TIDAK_TAHU => '9. Tidak Tahu',
    ];
}