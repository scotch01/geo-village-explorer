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
        Schema::create('service_methods', function (Blueprint $table) {

            $table->id();

            $table->foreignId('service_setting_id')
                ->constrained('service_settings')
                ->cascadeOnDelete();

            /**
             * Judul
             */
            $table->string('title');

            /**
             * Gambar (WebP)
             */
            $table->string('image_path')->nullable();

            /**
             * Link tujuan
             */
            $table->text('url')->nullable();

            /**
             * Urutan
             */
            $table->unsignedInteger('sort_order')
                ->default(0);

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
        Schema::dropIfExists('service_methods');
    }
};