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
        self::NIB => 'A. Nomor Induk Berusaha (NIB)',
        self::IUMK => 'B. Izin Usaha Mikro dan Kecil (IUMK)',
        self::BPOM => 'C. Badan Pengawas Obat dan Makanan',
        self::HALAL => 'D. Sertifikat Halal (MUI/Badan Penyelenggara Jaminan Produk Halal)',
        self::LAINNYA => 'E. Lainnya',
        self::TIDAK_MEMILIKI => 'X. Tidak Memiliki',
    ];
}