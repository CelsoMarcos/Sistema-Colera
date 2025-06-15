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
    Schema::create('gabinete_provincials', function (Blueprint $table) {
        $table->id(); // ID automático
        $table->string('nome'); // Nome do gabinete provincial
        $table->foreignId('provincia_id') // Chave estrangeira para ligar à tabela de provincias
              ->constrained()
              ->onDelete('cascade'); // Se a província for apagada, apaga também este gabinete
        $table->timestamps(); // Campos created_at e updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gabinete_provincials');
    }
};
