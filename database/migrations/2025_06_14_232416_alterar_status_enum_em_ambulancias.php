<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class AlterarStatusEnumEmAmbulancias extends Migration {
    /**
     * Run the migrations.
     */
    

public function up()
{
    // Altera o tipo da coluna 'status' para aceitar mais valores
    DB::statement("ALTER TABLE ambulancias MODIFY status ENUM('Disponível', 'Em Atendimento', 'Indisponível') DEFAULT 'Disponível'");
}

public function down()
{
    // Reverte para os valores antigos (caso precise)
    DB::statement("ALTER TABLE ambulancias MODIFY status ENUM('Disponível', 'Em Atendimento') DEFAULT 'Disponível'");
}

};
