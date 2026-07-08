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
        Schema::create('service_settings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('desa_id')
                ->constrained('desas')
                ->cascadeOnDelete()
                ->unique();

            /**
             * Maklumat Pelayanan
             */
            $table->string('maklumat_image')->nullable();

            /**
             * Contact
             */
            $table->string('whatsapp')->nullable();

            $table->string('email')->nullable();

            /**
             * SOP Permintaan Data
             */
            $table->text('sop_url')->nullable();

            /**
             * Status
             */
            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_settings');
    }
};