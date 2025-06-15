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
    Schema::table('gabinete_municipals', function (Blueprint $table) {
        $table->unsignedBigInteger('provincia_id')->after('nome');

        // Se quiser criar a relação:
        $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('gabinete_municipals', function (Blueprint $table) {
        $table->dropForeign(['provincia_id']);
        $table->dropColumn('provincia_id');
    });
}

};
