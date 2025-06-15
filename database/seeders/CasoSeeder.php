<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Caso;

class CasoSeeder extends Seeder
{
    public function run(): void
    {
        $casos = [
            [
                'paciente_nome' => 'Maria João',
                'idade' => 35,
                'sexo' => 'Feminino',
                'data_registro' => now(),
                'hospital_id' => 1,
                'estado' => 'Estável',
            ],
            [
                'paciente_nome' => 'Carlos Mário',
                'idade' => 22,
                'sexo' => 'Masculino',
                'data_registro' => now(),
                'hospital_id' => 2,
                'estado' => 'Crítico',
            ],
            [
                'paciente_nome' => 'Ana Manuel',
                'idade' => 27,
                'sexo' => 'Feminino',
                'data_registro' => now(),
                'hospital_id' => 3,
                'estado' => 'Recuperado',
            ],
        ];

        foreach ($casos as $caso) {
            Caso::create($caso);
        }
    }
}
