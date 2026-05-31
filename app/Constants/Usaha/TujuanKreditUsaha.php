<?php

namespace App\Constants\Usaha;

class TujuanKreditUsaha
{
    public const BAHAN_BAKU = 'A';
    public const GAJI_PEKERJA = 'B';
    public const OPERASIONAL_HARIAN = 'C';
    public const ASET = 'D';
    public const RENOVASI = 'E';
    public const PRODUK = 'F';
    public const PELUNASAN = 'G';
    public const LAINNYA = 'H';
    public const TIDAK_MEMINJAM = 'X';

    public const OPTIONS = [
        self::BAHAN_BAKU => 'A. Ya, untuk membeli bahan baku',
        self::GAJI_PEKERJA => 'B. Ya, untuk pembayaran upah/gaji pekerja',
        self::OPERASIONAL_HARIAN => 'C. Ya, untuk operasional harian',
        self::ASET => 'D. Ya, untuk membeli peralatan atau aset usaha',
        self::RENOVASI => 'E. Ya, untuk pembangunan atau renovasi tempat usaha',
        self::PRODUK => 'F. Ya, untuk pengembangan produk',
        self::PELUNASAN => 'G. Ya, melunasi pinjaman usaha sebelumnya',
        self::LAINNYA => 'H. Lainnya',
        self::TIDAK_MEMINJAM => 'X. Tidak Menerima Pinjaman',
    ];
}