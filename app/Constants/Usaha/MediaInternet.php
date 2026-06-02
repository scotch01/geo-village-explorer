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
        self::WEBSITE => 'A. Website',
        self::EMAIL => 'B. Email',
        self::PESAN_INSTAN => 'C. Pesan Instan (whatsapp, telegram dll)',
        self::MEDIA_SOSIAL => 'D. Media sosial (instagram, facebook, dll)',
        self::MARKETPLACE => 'E. Marketplace/platform digital (gojek, tokopedia, shopee, dll)',
        self::LAINNYA => 'F. Lainnya',
        self::TIDAK => 'X. Tidak Menggunakan Media Internet',
    ];
}