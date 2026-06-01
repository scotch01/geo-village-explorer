<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->string('nama_usaha')
                ->nullable()
                ->change();

            $table->string('nama_pemilik')
                ->nullable()
                ->change();

            $table->string('nik_pemilik', 16)
                ->nullable()
                ->change();

            $table->tinyInteger('jenis_kelamin_pemilik')
                ->nullable()
                ->change();

            $table->date('tanggal_lahir_pemilik')
                ->nullable()
                ->change();

            $table->tinyInteger('ijazah_pemilik')
                ->nullable()
                ->change();

            $table->tinyInteger('lokasi_usaha')
                ->nullable()
                ->change();

            $table->tinyInteger('status_bangunan')
                ->nullable()
                ->change();

            $table->text('kegiatan_utama')
                ->nullable()
                ->change();

            $table->text('produk_utama')
                ->nullable()
                ->change();

            $table->string('kategori_lapangan_usaha')
                ->nullable()
                ->change();

            $table->string('kbli')
                ->nullable()
                ->change();

            $table->year('tahun_mulai')
                ->nullable()
                ->change();

            $table->tinyInteger('bentuk_badan_usaha')
                ->nullable()
                ->change();

            $table->integer('jumlah_pekerja_dibayar')
                ->nullable()
                ->change();

            $table->bigInteger('total_upah_bulanan')
                ->nullable()
                ->change();

            $table->integer('jumlah_pekerja_tidak_dibayar')
                ->nullable()
                ->change();

            $table->bigInteger('pendapatan_bulanan')
                ->nullable()
                ->change();

            $table->bigInteger('pendapatan_tahunan')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('usahas', function (Blueprint $table) {

            $table->string('nama_usaha')
                ->nullable(false)
                ->change();

            $table->string('nama_pemilik')
                ->nullable(false)
                ->change();

            $table->string('nik_pemilik', 16)
                ->nullable(false)
                ->change();

            $table->tinyInteger('jenis_kelamin_pemilik')
                ->nullable(false)
                ->change();

            $table->date('tanggal_lahir_pemilik')
                ->nullable(false)
                ->change();

            $table->tinyInteger('ijazah_pemilik')
                ->nullable(false)
                ->change();

            $table->tinyInteger('lokasi_usaha')
                ->nullable(false)
                ->change();

            $table->tinyInteger('status_bangunan')
                ->nullable(false)
                ->change();

            $table->text('kegiatan_utama')
                ->nullable(false)
                ->change();

            $table->text('produk_utama')
                ->nullable(false)
                ->change();

            $table->string('kategori_lapangan_usaha')
                ->nullable(false)
                ->change();

            $table->string('kbli')
                ->nullable(false)
                ->change();

            $table->year('tahun_mulai')
                ->nullable(false)
                ->change();

            $table->tinyInteger('bentuk_badan_usaha')
                ->nullable(false)
                ->change();

            $table->integer('jumlah_pekerja_dibayar')
                ->nullable(false)
                ->change();

            $table->bigInteger('total_upah_bulanan')
                ->nullable(false)
                ->change();

            $table->integer('jumlah_pekerja_tidak_dibayar')
                ->nullable(false)
                ->change();

            $table->bigInteger('pendapatan_bulanan')
                ->nullable(false)
                ->change();

            $table->bigInteger('pendapatan_tahunan')
                ->nullable(false)
                ->change();
        });
    }
};