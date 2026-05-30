<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->dropIndex(['sektor']);

            $table->dropColumn([
                'sektor',
                'nama_pemilik',
                'no_hp',
                'deskripsi',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->string('sektor');

            $table->string('nama_pemilik')
                ->nullable();

            $table->string('no_hp')
                ->nullable();

            $table->text('deskripsi')
                ->nullable();

            $table->index('sektor');
        });
    }
};