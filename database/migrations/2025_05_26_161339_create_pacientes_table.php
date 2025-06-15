<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('numero_bi')->unique();
            $table->string('telefone');
            $table->enum('sexo', ['Masculino', 'Feminino', 'Outro']);
            $table->foreignId('provincia_id')->constrained('provincias');
            $table->text('sintomas');
            $table->enum('estado', ['Suspeito', 'Confirmado', 'Descartado']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
};