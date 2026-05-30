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
        self::PERANGKAT => 'Tidak memiliki perangkat (HP, laptop, dll)',
        self::KEMAMPUAN => 'Tidak memiliki kemampuan untuk memanfaatkan internet',
        self::AKSES => 'Tidak ada akses internet',
        self::KHAWATIR => 'Khawatir mengenai penggunaan internet',
        self::LAINNYA => 'Lainnya',
        self::TIDAK => 'Tidak Menggunakan Internet',
    ];
}