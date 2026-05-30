<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_keluargas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('keluarga_id')
                ->constrained('keluargas')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger(
                'nomor_urut'
            );

            $table->string('nama');

            $table->string('nik', 16);

            $table->tinyInteger(
                'hubungan_keluarga'
            );

            $table->tinyInteger(
                'status_perkawinan'
            );

            $table->date(
                'tanggal_lahir'
            );

            $table->tinyInteger(
                'jenis_kelamin'
            );

            $table->tinyInteger(
                'partisipasi_sekolah'
            )->nullable();

            $table->tinyInteger(
                'ijazah_tertinggi'
            )->nullable();

            $table->string(
                'kode_profesi',
                10
            )->nullable();

            $table->tinyInteger(
                'status_pekerjaan'
            )->nullable();

            $table->tinyInteger(
                'rekening_digital'
            )->nullable();

            /**
             * MULTI SELECT
             */

            $table->json('disabilitas')
                ->nullable();

            $table->json('penyakit_kronis')
                ->nullable();

            $table->json('jaminan_kesehatan')
                ->nullable();

            $table->timestamps();

            $table->index('keluarga_id');

            $table->index('nik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_keluargas');
    }
};