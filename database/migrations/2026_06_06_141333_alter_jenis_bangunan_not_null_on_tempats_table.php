<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->string('jenis_bangunan')
                ->nullable(false)
                ->change();

        });
    }

    public function down(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->string('jenis_bangunan')
                ->nullable()
                ->change();

        });
    }
};