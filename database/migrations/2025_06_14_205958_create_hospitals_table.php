<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('hospitals', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('categoria'); // Ex: Hospital Geral, Posto Médico
        $table->unsignedBigInteger('provincia_id');
        $table->unsignedBigInteger('municipio_id');
        $table->string('status')->default('Ativo'); // Ativo, Inativo, etc.
        $table->timestamps();

        // Chaves estrangeiras
        $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
        $table->foreign('municipio_id')->references('id')->on('gabinete_municipals')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
