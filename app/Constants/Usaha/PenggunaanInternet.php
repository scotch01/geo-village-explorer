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
        self::PESANAN => 'Menerima pesanan',
        self::BAHAN_BAKU => 'Membeli bahan baku',
        self::PROMOSI => 'Promosi atau pemasaran',
        self::TRANSAKSI => 'Pembayaran transaksi penjualan dan/atau pembelian',
        self::LAINNYA => 'Lainnya  (misal mencari informasi pengembangan usaha, pengembangan produk, dll)',
        self::TIDAK => 'Tidak Menggunakan Internet',
    ];
}