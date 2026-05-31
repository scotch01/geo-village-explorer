<?php

namespace App\Constants\Usaha;

class PenggunaanInternet
{
    public const PESANAN = 'A';
    public const BAHAN_BAKU = 'B';
    public const PROMOSI = 'C';
    public const TRANSAKSI = 'D';
    public const LAINNYA = 'E';
    public const TIDAK = 'X';

    public const OPTIONS = [
        self::PESANAN => 'A. Menerima pesanan',
        self::BAHAN_BAKU => 'B. Membeli bahan baku',
        self::PROMOSI => 'C. Promosi atau pemasaran',
        self::TRANSAKSI => 'D. Pembayaran transaksi penjualan dan/atau pembelian',
        self::LAINNYA => 'E. Lainnya  (misal mencari informasi pengembangan usaha, pengembangan produk, dll)',
        self::TIDAK => 'X. Tidak Menggunakan Internet',
    ];
}