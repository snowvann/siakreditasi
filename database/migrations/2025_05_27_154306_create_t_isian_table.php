<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTIsianTable extends Migration
{
    public function up()
    {
        Schema::create('t_isian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akreditasi_id')->constrained('akreditasi')->onDelete('cascade');
            $table->foreignId('subkriteria_id')->constrained('subkriteria')->onDelete('cascade');
            $table->text('nilai')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_isian');
    }
}
