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
            'portal_items',
            function (Blueprint $table) {

                $table->id();

                $table->foreignId(
                    'portal_category_id'
                )
                ->constrained()
                ->cascadeOnDelete();

                /**
                 * Judul item
                 *
                 * contoh:
                 * Tabel 2.1 Banyaknya Usaha ...
                 */
                $table->string('title');

                 /**
                 * Deskripsi singkat
                 */
                $table->text('description')
                    ->nullable();

                /**
                 * File Type
                 */
                $table->string('file_type')
                    ->nullable();

                /**
                 * Link tujuan
                 * bisa:
                 * pdf
                 * spreadsheet
                 * drive
                 * website
                 */
                $table->text('url');

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
            'portal_items'
        );
    }
};