<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->tinyInteger(
                'tidak_menerima_kredit'
            )
            ->nullable()
            ->after('tujuan_pinjaman');

        });
    }

    public function down(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->dropColumn(
                'tidak_menerima_kredit'
            );

        });
    }
};