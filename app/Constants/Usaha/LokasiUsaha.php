<?php

namespace App\Constants\Usaha;

class LokasiUsaha
{
    public const DALAM_BTT = 1;
    public const DALAM_BKU = 2;
    public const KAKI_LIMA = 3;
    public const KELILING = 4;

    public const OPTIONS = [
        self::DALAM_BTT => '1. Di dalam bangunan tempat tinggal',
        self::DALAM_BKU => '2. Di dalam bangunan khusus usaha',
        self::KAKI_LIMA => '3. Di luar bangunan dengan lokasi tetap dan perlengkapan usaha dipindah/dibongkar pasang (kaki lima)',
        self::KELILING => '4. Usaha keliling',
    ];
}