<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id(); // Kolom ID utama
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade'); // Relasi ke tabel kriteria
            $table->string('title'); // Judul pengajuan
            $table->text('description')->nullable(); // Deskripsi pengajuan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}