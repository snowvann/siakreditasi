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
        Schema::create('kriteria_user_access', function (Blueprint $table) {
            $table->foreignId('kriteria_id')->constrained('kriteria_user')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('baca')->default(false);
            $table->boolean('tulis')->default(false);
            $table->boolean('validasi')->default(false);
            $table->timestamps();
            
            $table->primary(['kriteria_id', 'user_id']); // Composite key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_user_access');
    }
};
