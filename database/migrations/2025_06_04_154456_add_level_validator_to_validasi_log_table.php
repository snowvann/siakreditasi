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
        Schema::table('validasi_log', function (Blueprint $table) {
            $table->tinyInteger('level_validator')->after('user_id')->default(1); // 1: Kajur/KPS, 2: KJM/Direktur
        });
    }

    public function down(): void
    {
        Schema::table('validasi_log', function (Blueprint $table) {
            $table->dropColumn('level_validator');
        });
    }

};
