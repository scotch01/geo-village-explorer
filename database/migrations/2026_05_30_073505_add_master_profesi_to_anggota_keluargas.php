<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggota_keluargas', function (Blueprint $table) {

            $table->foreignId('master_profesi_id')
                ->nullable()
                ->after('ijazah_tertinggi')
                ->constrained('master_profesis')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('anggota_keluargas', function (Blueprint $table) {

            $table->dropForeign([
                'master_profesi_id'
            ]);

            $table->dropColumn(
                'master_profesi_id'
            );
        });
    }
};