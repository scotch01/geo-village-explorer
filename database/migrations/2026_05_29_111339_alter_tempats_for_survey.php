<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->string('jenis_bangunan')
                ->nullable()
                ->after('nama_tempat');

            /**
             * BTT
             * BKU
             * BC
             */

            $table->string('foto_bangunan')
                ->nullable()
                ->after('longitude');

            $table->text('catatan')
                ->nullable()
                ->after('foto_bangunan');

            $table->index('jenis_bangunan');
        });
    }

    public function down(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->dropIndex(['jenis_bangunan']);

            $table->dropColumn([
                'jenis_bangunan',
                'foto_bangunan',
                'catatan',
            ]);
        });
    }
};