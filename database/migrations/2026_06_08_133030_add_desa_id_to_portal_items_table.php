<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations.
     */
    public function up(): void
    {
        Schema::table(
            'portal_items',
            function (Blueprint $table) {

                $table->foreignId('desa_id')
                    ->after('portal_category_id')
                    ->constrained()
                    ->cascadeOnDelete();

            }
        );
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::table(
            'portal_items',
            function (Blueprint $table) {

                $table->dropConstrainedForeignId(
                    'desa_id'
                );

            }
        );
    }
};