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
        Schema::table('keluargas', function (Blueprint $table) {

            $table->tinyInteger('alamat_sesuai_kk')
                ->nullable()
                ->change();

            $table->smallInteger('jumlah_keluarga_dalam_rumah')
                ->nullable()
                ->change();

            $table->tinyInteger('status_kepemilikan_rumah')
                ->nullable()
                ->change();

            $table->integer('luas_lantai')
                ->nullable()
                ->change();

            $table->tinyInteger('bahan_lantai')
                ->nullable()
                ->change();

            $table->tinyInteger('bahan_dinding')
                ->nullable()
                ->change();

            $table->tinyInteger('bahan_atap')
                ->nullable()
                ->change();

            $table->tinyInteger('fasilitas_bab')
                ->nullable()
                ->change();

            $table->tinyInteger('jenis_kloset')
                ->nullable()
                ->change();

            $table->tinyInteger('pembuangan_tinja')
                ->nullable()
                ->change();

            $table->tinyInteger('sumber_air_minum')
                ->nullable()
                ->change();

            $table->tinyInteger('sumber_penerangan')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keluargas', function (Blueprint $table) {

            $table->tinyInteger('alamat_sesuai_kk')
                ->nullable(false)
                ->change();

            $table->smallInteger('jumlah_keluarga_dalam_rumah')
                ->nullable(false)
                ->change();

            $table->tinyInteger('status_kepemilikan_rumah')
                ->nullable(false)
                ->change();

            $table->integer('luas_lantai')
                ->nullable(false)
                ->change();

            $table->tinyInteger('bahan_lantai')
                ->nullable(false)
                ->change();

            $table->tinyInteger('bahan_dinding')
                ->nullable(false)
                ->change();

            $table->tinyInteger('bahan_atap')
                ->nullable(false)
                ->change();

            $table->tinyInteger('fasilitas_bab')
                ->nullable(false)
                ->change();

            $table->tinyInteger('jenis_kloset')
                ->nullable(false)
                ->change();

            $table->tinyInteger('pembuangan_tinja')
                ->nullable(false)
                ->change();

            $table->tinyInteger('sumber_air_minum')
                ->nullable(false)
                ->change();

            $table->tinyInteger('sumber_penerangan')
                ->nullable(false)
                ->change();
        });
    }
};
