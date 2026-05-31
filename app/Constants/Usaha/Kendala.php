<?php

namespace App\Constants\Usaha;

class Kendala
{
    public const BAHAN_BAKU_SULIT = 'A';
    public const HARGA = 'B';
    public const MODAL = 'C';
    public const KESULITAN_PEMASARAN = 'D';
    public const KESULITAN_IZIN = 'E';
    public const KURANG_PENGETAHUAN = 'F';
    public const LAINNYA = 'G';
    public const TIDAK_MENGALAMI = 'X';

    public const OPTIONS = [
        self::BAHAN_BAKU_SULIT => 'A. Bahan baku sulit didapat',
        self::HARGA => 'B. Kenaikan harga bahan baku',
        self::MODAL => 'C. Kurangnya modal usaha',
        self::KESULITAN_PEMASARAN => 'D. Kesulitan pemasaran/penjualan produk',
        self::KESULITAN_IZIN => 'E. Kesulitan dalam perizinan usaha',
        self::KURANG_PENGETAHUAN => 'F. Kurangnya pengetahuan atau keterampilan untuk pengembangan usaha',
        self::LAINNYA => 'G. Lainnya',
        self::TIDAK_MENGALAMI => 'X. Tidak Mengalami Kesulitan',
    ];
}