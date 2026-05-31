<?php

namespace App\Constants\Keluarga;

class KreditTujuan
{
    public const PENDIDIKAN = 'A';
    public const KESEHATAN = 'B';
    public const KONSUMSI = 'C';
    public const BARANG_SEKUNDER = 'D';
    public const MEMBELI_ASET = 'E';
    public const LAINNYA = 'F';
    public const TIDAK_MEMINJAM = 'X';

    public const OPTIONS = [

        self::PENDIDIKAN => 'A. Biaya Pendidikan',
        self::KESEHATAN => 'B. Biaya Kesehatan',
        self::KONSUMSI => 'C. Konsumsi Sehari-hari',
        self::BARANG_SEKUNDER => 'D. Membeli Barang Sekunder/Tersier',
        self::MEMBELI_ASET => 'E. Membeli Aset',
        self::LAINNYA => 'F. Lainnya',
        self::TIDAK_MEMINJAM => 'X. Tidak Melakukan Pinjaman/Kredit',
    ];
}