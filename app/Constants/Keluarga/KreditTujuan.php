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

        self::PENDIDIKAN => 'Biaya Pendidikan',
        self::KESEHATAN => 'Biaya Kesehatan',
        self::KONSUMSI => 'Konsumsi Sehari-hari',
        self::BARANG_SEKUNDER => 'Membeli Barang Sekunder/Tersier',
        self::MEMBELI_ASET => 'Membeli Aset',
        self::LAINNYA => 'Lainnya',
        self::TIDAK_MEMINJAM => 'Tidak Melakukan Pinjaman/Kredit',
    ];
}