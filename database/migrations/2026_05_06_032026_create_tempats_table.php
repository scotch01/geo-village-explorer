<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tempats', function (Blueprint $table) {

            $table->id();

            /**
             * CORE DATA
             */

            $table->string('nama_tempat');

            /**
             * DOMAIN
             */

            $table->string('sektor');

            // khusus sektor ekonomi
            $table->string('skala_usaha')->nullable();

            /**
             * INFORMASI TAMBAHAN
             */

            // nullable karena sekolah/RS bisa tidak punya pemilik
            $table->string('nama_pemilik')->nullable();

            $table->text('alamat');

            $table->string('no_hp')->nullable();

            $table->text('deskripsi')->nullable();

            /**
             * GEOLOCATION
             */

            // presisi tinggi untuk clustering map
            $table->decimal('latitude', 10, 7);

            $table->decimal('longitude', 10, 7);

            /**
             * FUTURE RBAC
             */

            // nanti relasi ke desa
            $table->unsignedBigInteger('id_desa')->nullable();

            // creator/admin desa
            $table->unsignedBigInteger('created_by')->nullable();

            /**
             * STATUS
             */

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            /**
             * INDEXING
             */

            $table->index(['latitude', 'longitude']);
            $table->index('sektor');
            $table->index('skala_usaha');
            $table->index('id_desa');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tempats');
    }
};