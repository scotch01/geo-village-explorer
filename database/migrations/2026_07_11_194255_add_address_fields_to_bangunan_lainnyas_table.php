<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bangunan_lainnyas', function (Blueprint $table) {

            $table->string('provinsi')
                ->nullable()
                ->after('kategori');

            $table->string('kabupaten')
                ->nullable()
                ->after('provinsi');

            $table->string('kecamatan')
                ->nullable()
                ->after('kabupaten');

            $table->string('desa')
                ->nullable()
                ->after('kecamatan');

            $table->string('dusun')
                ->nullable()
                ->after('desa');

        });
    }

    public function down(): void
    {
        Schema::table('bangunan_lainnyas', function (Blueprint $table) {

            $table->dropColumn([
                'provinsi',
                'kabupaten',
                'kecamatan',
                'desa',
                'dusun',
            ]);

        });
    }
};