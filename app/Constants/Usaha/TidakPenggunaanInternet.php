<?php

namespace App\Constants\Usaha;

class TidakPenggunaanInternet
{
    public const PERANGKAT = 'A';
    public const KEMAMPUAN = 'B';
    public const AKSES = 'C';
    public const KHAWATIR = 'D';
    public const LAINNYA = 'E';
    public const TIDAK = 'X';

    public const OPTIONS = [
        self::PERANGKAT => 'A. Tidak memiliki perangkat (HP, laptop, dll)',
        self::KEMAMPUAN => 'B. Tidak memiliki kemampuan untuk memanfaatkan internet',
        self::AKSES => 'C. Tidak ada akses internet',
        self::KHAWATIR => 'D. Khawatir mengenai penggunaan internet',
        self::LAINNYA => 'E. Lainnya',
        self::TIDAK => 'X. Menggunakan Internet',
    ];
}