<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            /**
             * ROLE
             */
            $table->string('role')
                ->default('admin_desa')
                ->after('email');

            /**
             * RELASI DESA
             */
            $table->unsignedBigInteger('id_desa')
                ->nullable()
                ->after('role');

            $table->foreign('id_desa')
                ->references('id')
                ->on('desas')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['id_desa']);

            $table->dropColumn([
                'role',
                'id_desa'
            ]);
        });
    }
};