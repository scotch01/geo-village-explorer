<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE tempats
            MODIFY latitude DECIMAL(10,7) NULL
        ");

        DB::statement("
            ALTER TABLE tempats
            MODIFY longitude DECIMAL(10,7) NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE tempats
            MODIFY latitude DECIMAL(10,7) NOT NULL
        ");

        DB::statement("
            ALTER TABLE tempats
            MODIFY longitude DECIMAL(10,7) NOT NULL
        ");
    }
};