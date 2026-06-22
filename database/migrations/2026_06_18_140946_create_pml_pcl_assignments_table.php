<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pml_pcl_assignments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pml_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('pcl_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'pml_id',
                'pcl_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'pml_pcl_assignments'
        );
    }
};