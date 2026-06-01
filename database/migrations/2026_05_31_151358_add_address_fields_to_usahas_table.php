<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->string('provinsi')
                ->nullable()
                ->after('tempat_id');

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

            $table->text('alamat')
                ->nullable()
                ->after('dusun');
        });
    }

    public function down(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->dropColumn([
                'provinsi',
                'kabupaten',
                'kecamatan',
                'desa',
                'dusun',
                'alamat',
            ]);
        });
    }
};