<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->foreign('id_desa')
                ->references('id')
                ->on('desas')
                ->nullOnDelete();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tempats', function (Blueprint $table) {

            $table->dropForeign(['id_desa']);
            $table->dropForeign(['created_by']);
        });
    }
};