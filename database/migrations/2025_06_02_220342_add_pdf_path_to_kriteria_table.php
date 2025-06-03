<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPdfPathToKriteriaTable extends Migration
{
    public function up()
    {
        Schema::table('kriteria', function (Blueprint $table) {
            $table->string('pdf_path')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('kriteria', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
        });
    }
}