<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulanciasTable extends Migration
{
    public function up(): void
    {
        Schema::create('ambulancias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('matricula')->unique(); // Placa do veículo
            $table->foreignId('hospital_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Disponível', 'Em Atendimento', 'Manutenção'])->default('Disponível');
            $table->string('localizacao')->nullable(); // Podes usar GPS ou descrição
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ambulancias');
    }
}

