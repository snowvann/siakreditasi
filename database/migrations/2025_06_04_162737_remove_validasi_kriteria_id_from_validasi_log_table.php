<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveValidasiKriteriaIdFromValidasiLogTable extends Migration
{
    public function up()
    {
        Schema::table('validasi_log', function (Blueprint $table) {
            // Hapus foreign key dulu sebelum hapus kolom
            $table->dropForeign(['validasi_kriteria_id']);
            $table->dropColumn('validasi_kriteria_id');
        });
    }

    public function down()
    {
        Schema::table('validasi_log', function (Blueprint $table) {
            $table->foreignId('validasi_kriteria_id')->constrained('validasi_kriteria')->onDelete('cascade');
        });
    }
}

