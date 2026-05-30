<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keluargas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('tempat_id')
                ->constrained('tempats')
                ->cascadeOnDelete();

            /**
             * BLOK II
             */

            $table->string('nama_kepala_keluarga');

            $table->string('nik_kepala_keluarga', 16);

            $table->string('nomor_kk', 16);

            $table->string('provinsi');

            $table->string('kabupaten');

            $table->string('kecamatan');

            $table->string('desa');

            $table->string('dusun')
                ->nullable();

            $table->text('alamat_detail');

            $table->tinyInteger('alamat_sesuai_kk');

            $table->unsignedSmallInteger(
                'jumlah_keluarga_dalam_rumah'
            );

            /**
             * BLOK PERUMAHAN
             */

            $table->tinyInteger(
                'status_kepemilikan_rumah'
            );

            $table->unsignedInteger(
                'luas_lantai'
            );

            $table->tinyInteger(
                'bahan_lantai'
            );

            $table->tinyInteger(
                'bahan_dinding'
            );

            $table->tinyInteger(
                'bahan_atap'
            );

            $table->tinyInteger(
                'fasilitas_bab'
            );

            $table->tinyInteger(
                'jenis_kloset'
            );

            $table->tinyInteger(
                'pembuangan_tinja'
            );

            $table->tinyInteger(
                'sumber_air_minum'
            );

            $table->tinyInteger(
                'sumber_penerangan'
            );

            $table->unsignedTinyInteger(
                'jumlah_meteran'
            )->nullable();

            $table->unsignedSmallInteger(
                'daya_listrik'
            )->nullable();

            /**
             * KREDIT
             * Multi Select
             */

            $table->json('kredit_sumber')
                ->nullable();

            $table->json('kredit_tujuan')
                ->nullable();

            /**
             * GEOTAGGING RUMAH
             */

            $table->decimal(
                'latitude_rumah',
                10,
                7
            )->nullable();

            $table->decimal(
                'longitude_rumah',
                10,
                7
            )->nullable();

            $table->timestamps();

            $table->index('tempat_id');

            $table->index([
                'latitude_rumah',
                'longitude_rumah'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keluargas');
    }
};