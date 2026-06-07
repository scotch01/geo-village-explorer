<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->decimal(
                'akurasi_usaha',
                8,
                2
            )->nullable()
            ->after('longitude_usaha');

        });
    }

    public function down(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->dropColumn(
                'akurasi_usaha'
            );

        });
    }
};
