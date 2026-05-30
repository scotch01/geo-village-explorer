<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usahas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('tempat_id')
                ->constrained('tempats')
                ->cascadeOnDelete();

            $table->string('nama_usaha');

            $table->string('telepon')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->string('website')
                ->nullable();

            $table->string('nama_pemilik');

            $table->string(
                'nik_pemilik',
                16
            );

            $table->tinyInteger(
                'jenis_kelamin_pemilik'
            );

            $table->date(
                'tanggal_lahir_pemilik'
            );

            $table->tinyInteger(
                'ijazah_pemilik'
            );

            $table->tinyInteger(
                'lokasi_usaha'
            );

            $table->tinyInteger(
                'status_bangunan'
            );

            $table->text(
                'kegiatan_utama'
            );

            $table->text(
                'produk_utama'
            );

            $table->string(
                'kategori_lapangan_usaha'
            );

            $table->string(
                'kbli'
            );

            $table->year(
                'tahun_mulai'
            );

            /**
             * MULTI SELECT
             */

            $table->json('izin_usaha')
                ->nullable();

            $table->tinyInteger(
                'bentuk_badan_usaha'
            );

            $table->integer(
                'jumlah_pekerja_dibayar'
            )->default(0);

            $table->bigInteger(
                'total_upah_bulanan'
            )->default(0);

            $table->integer(
                'jumlah_pekerja_tidak_dibayar'
            )->default(0);

            $table->bigInteger(
                'pendapatan_bulanan'
            )->default(0);

            $table->bigInteger(
                'pendapatan_tahunan'
            )->default(0);

            $table->json(
                'penggunaan_internet'
            )->nullable();

            $table->json(
                'media_internet'
            )->nullable();

            $table->json(
                'alasan_tidak_internet'
            )->nullable();

            $table->json(
                'sumber_pinjaman'
            )->nullable();

            $table->json(
                'tujuan_pinjaman'
            )->nullable();

            $table->json(
                'kendala_usaha'
            )->nullable();

            /**
             * GEOTAGGING USAHA
             */

            $table->decimal(
                'latitude_usaha',
                10,
                7
            )->nullable();

            $table->decimal(
                'longitude_usaha',
                10,
                7
            )->nullable();

            $table->timestamps();

            $table->index('tempat_id');

            $table->index([
                'latitude_usaha',
                'longitude_usaha'
            ]);

            $table->index('kbli');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usahas');
    }
};