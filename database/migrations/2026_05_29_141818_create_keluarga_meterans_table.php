<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keluarga_meterans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('keluarga_id')
                ->constrained('keluargas')
                ->cascadeOnDelete();

            /**
             * Daya listrik meteran
             *
             * 1 = 450
             * 2 = 900
             * 3 = 1300
             * 4 = 2200
             * 5 = >2200
             */
            $table->tinyInteger('daya_listrik');

            $table->timestamps();

            $table->index('keluarga_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keluarga_meterans');
    }
};