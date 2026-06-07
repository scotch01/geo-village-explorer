<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->boolean(
                'lokasi_sama_dengan_keluarga'
            )
            ->default(false)
            ->after('akurasi_usaha');

        });
    }

    public function down(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->dropColumn(
                'lokasi_sama_dengan_keluarga'
            );

        });
    }
};