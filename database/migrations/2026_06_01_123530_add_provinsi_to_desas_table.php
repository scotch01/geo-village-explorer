<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('desas', function (Blueprint $table) {

            $table->string('provinsi')
                ->nullable()
                ->after('kode_desa');

        });
    }

    public function down(): void
    {
        Schema::table('desas', function (Blueprint $table) {

            $table->dropColumn('provinsi');

        });
    }
};
