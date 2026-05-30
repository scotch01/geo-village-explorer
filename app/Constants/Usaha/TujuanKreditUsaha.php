<?php

namespace App\Constants\Keluarga;

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

        self::BAHAN_BAKU => 'Ya, untuk membeli bahan baku',
        self::GAJI_PEKERJA => 'Ya, untuk pembayaran upah/gaji pekerja',
        self::OPERASIONAL_HARIAN => 'Ya, untuk operasional harian',
        self::ASET => 'Ya, untuk membeli peralatan atau aset usaha',
        self::RENOVASI => 'Ya, untuk pembangunan atau renovasi tempat usaha',
        self::PRODUK => 'Ya, untuk pengembangan produk',
        self::PELUNASAN => 'Ya, melunasi pinjaman usaha sebelumnya',
        self::LAINNYA => 'Lainnya',
        self::TIDAK_MEMINJAM => 'Tidak Menerima Pinjaman',
    ];
}