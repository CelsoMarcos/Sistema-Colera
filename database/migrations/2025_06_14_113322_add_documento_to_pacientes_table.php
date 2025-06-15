<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('pacientes', function (Blueprint $table) {
        $table->string('documento')->nullable(); // Caminho do documento
    });
}

public function down()
{
    Schema::table('pacientes', function (Blueprint $table) {
        $table->dropColumn('documento');
    });
}

};
