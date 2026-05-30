<?php

namespace App\Constants\Usaha;

class MediaInternet
{
    public const WEBSITE = 'A';
    public const EMAIL = 'B';
    public const PESAN_INSTAN = 'C';
    public const MEDIA_SOSIAL = 'D';
    public const MARKETPLACE = 'E';
    public const LAINNYA = 'F';
    public const TIDAK = 'X';

    public const OPTIONS = [
        self::WEBSITE => 'Website',
        self::EMAIL => 'Email',
        self::PESAN_INSTAN => 'Pesan Instan (whatsapp, telegram dll)',
        self::MEDIA_SOSIAL => 'Media sosial (instagram, facebook, dll)',
        self::MARKETPLACE => 'Marketplace/platform digital (gojek, tokopedia, shopee, dll)',
        self::LAINNYA => 'Lainnya',
        self::TIDAK => 'Tidak Menggunakan Internet',
    ];
}