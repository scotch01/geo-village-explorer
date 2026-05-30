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
        self::BAHAN_BAKU_SULIT => 'Bahan baku sulit didapat',
        self::HARGA => 'Kenaikan harga bahan baku',
        self::MODAL => 'Kurangnya modal usaha',
        self::KESULITAN_PEMASARAN => 'Kesulitan pemasaran/penjualan produk',
        self::KESULITAN_IZIN => 'Kesulitan dalam perizinan usaha',
        self::KURANG_PENGETAHUAN => 'Kurangnya pengetahuan atau keterampilan untuk pengembangan usaha',
        self::LAINNYA => 'Lainnya',
        self::TIDAK_MENGALAMI => 'Tidak Mengalami Kesulitan',
    ];
}