<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalSeeder extends Seeder
{
    public function run(): void
    {
        // Array com os dados dos hospitais a serem inseridos
        $dados = [
            [
                'nome' => 'Hospital Geral do Lubango',
                'municipio_id' => 10,    // ID do município "Lubango" (deve existir em gabinete_municipals)
                'provincia_id' => 10,    // ID da província "Huíla"
                'status' => 'Ativo',     // Estado do hospital
            ],
            [
                'nome' => 'Hospital Municipal do Sumbe',
                'municipio_id' => 7,     // ID do município "Sumbe"
                'provincia_id' => 7,     // ID da província "Cuanza Sul"
                'status' => 'Ativo',
            ],
            [
                'nome' => 'Centro de Saúde de Caxito',
                'municipio_id' => 1,     // ID do município "Caxito"
                'provincia_id' => 1,     // ID da província "Bengo"
                'status' => 'Ativo',
            ],
            [
                'nome' => 'Clínica Esperança',
                'municipio_id' => 11,    // ID do município "Luanda"
                'provincia_id' => 11,    // ID da província "Luanda"
                'status' => 'Ativo',
            ],
            [
                'nome' => 'Posto Médico de Malanje',
                'municipio_id' => 12,    // ID do município "Malanje"
                'provincia_id' => 12,    // ID da província "Malanje"
                'status' => 'Ativo',
            ],
        ];

        // Loop para criar cada hospital no banco de dados
        foreach ($dados as $hospital) {
            Hospital::create($hospital); // Insere o hospital com os dados indicados
        }
    }
}
