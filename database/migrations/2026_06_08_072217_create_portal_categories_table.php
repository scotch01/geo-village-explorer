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
        Schema::create(
            'portal_categories',
            function (Blueprint $table) {

                $table->id();

                /**
                 * Tipe menu
                 * publication
                 * village_data
                 * metadata
                 * infographic
                 */
                $table->string('type');

                /**
                 * Nama heading
                 * contoh:
                 * Profil Industri Pengolahan
                 * Kependudukan
                 * Pendidikan
                 */
                $table->string('name');

                /**
                 * profil-industri-pengolahan
                 */
                $table->string('slug')->unique();

                /**
                 * Urutan tampil
                 */
                $table->unsignedInteger('sort_order')
                    ->default(0);

                /**
                 * Aktif / nonaktif
                 */
                $table->boolean('is_active')
                    ->default(true);

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'portal_categories'
        );
    }
};