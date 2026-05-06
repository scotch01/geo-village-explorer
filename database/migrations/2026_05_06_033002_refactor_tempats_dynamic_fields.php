<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            /**
             * Hapus field hardcoded
             * karena nanti pertanyaan akan dinamis
             */
            $table->dropColumn('skala_usaha');

            /**
             * Dynamic questionnaire data
             */
            $table->json('metadata')
                ->nullable()
                ->after('sektor');
        });
    }

    public function down(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->dropColumn('metadata');

            $table->string('skala_usaha')
                ->nullable()
                ->after('sektor');
        });
    }
};