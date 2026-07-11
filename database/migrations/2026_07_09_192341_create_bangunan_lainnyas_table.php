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
        Schema::create('bangunan_lainnyas', function (Blueprint $table) {

            $table->id();

            /**
             * Parent Tempat
             */
            $table->foreignId('tempat_id')
                ->constrained()
                ->cascadeOnDelete();

            /**
             * Nama Infrastruktur
             */
            $table->string('nama_infrastruktur');

            /**
             * Kategori
             * 1 = Pendidikan
             * 2 = Kesehatan
             * 3 = Perbankan
             */
            $table->unsignedTinyInteger('kategori');

            /**
             * Informasi Kontak
             */
            $table->text('alamat')->nullable();

            $table->string('email')
                ->nullable();

            $table->string('website')
                ->nullable();

            /**
             * GPS
             */
            $table->decimal(
                'latitude',
                10,
                7
            )->nullable();

            $table->decimal(
                'longitude',
                10,
                7
            )->nullable();

            $table->decimal(
                'akurasi',
                8,
                2
            )->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bangunan_lainnyas');
    }
};