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
    Schema::create('gabinete_municipals', function (Blueprint $table) {
        $table->id(); // ID automático
        $table->string('nome'); // Nome do gabinete municipal
        $table->string('municipio'); // Nome do município
        $table->foreignId('gabinete_provincial_id') // Chave estrangeira para ligar ao gabinete provincial
              ->constrained()
              ->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gabinete_municipals');
    }
};
