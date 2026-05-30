<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keluargas', function (Blueprint $table) {

            $table->dropColumn([
                'jumlah_meteran',
                'daya_listrik',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('keluargas', function (Blueprint $table) {

            $table->unsignedTinyInteger(
                'jumlah_meteran'
            )->nullable();

            $table->unsignedSmallInteger(
                'daya_listrik'
            )->nullable();
        });
    }
};