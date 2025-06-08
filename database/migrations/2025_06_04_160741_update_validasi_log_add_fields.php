<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateValidasiLogAddFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('validasi_log', function (Blueprint $table) {
            // Tambah kolom kriteria_id dan relasinya
            $table->foreignId('kriteria_id')->nullable()->after('id')->constrained('kriteria')->onDelete('cascade');
            
            // Tambah level_validator

            // Tambah status validasi
            $table->enum('status', ['valid', 'tidak valid'])->nullable()->after('level_validator');

            // Ubah nama kolom catatan jadi komentar (opsional)
            if (Schema::hasColumn('validasi_log', 'catatan')) {
                $table->renameColumn('catatan', 'komentar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('validasi_log', function (Blueprint $table) {
            // Drop kolom baru jika rollback
            $table->dropForeign(['kriteria_id']);
            $table->dropColumn(['kriteria_id', 'status']);

            // Kembalikan nama komentar jadi catatan jika sebelumnya diganti
            if (Schema::hasColumn('validasi_log', 'komentar')) {
                $table->renameColumn('komentar', 'catatan');
            }
        });
    }
}

