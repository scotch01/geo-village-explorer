<?php

namespace App\Constants\Usaha;

class IzinUsaha
{
    public const NIB = 'A';
    public const IUMK = 'B';
    public const BPOM = 'C';
    public const HALAL = 'D';
    public const LAINNYA = 'E';
    public const TIDAK_MEMILIKI = 'X';

    public const OPTIONS = [
        self::NIB => 'Nomor Induk Berusaha (NIB)',
        self::IUMK => 'Izin Usaha Mikro dan Kecil (IUMK)',
        self::BPOM => 'Badan Pengawas Obat dan Makanan',
        self::HALAL => 'Sertifikat Halal (MUI/Badan Penyelenggara Jaminan Produk Halal)',
        self::LAINNYA => 'Lainnya',
        self::TIDAK_MEMILIKI => 'Tidak Memiliki',
    ];
}