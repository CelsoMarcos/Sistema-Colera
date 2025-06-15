<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->string('paciente_nome');
            $table->integer('idade');
            $table->enum('sexo', ['Masculino', 'Feminino']);
            $table->date('data_registro');
            $table->unsignedBigInteger('hospital_id');
            $table->enum('estado', ['Estável', 'Crítico', 'Recuperado', 'Falecido']);
            $table->timestamps();

            // Relacionamento com hospital
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('casos');
    }
};

