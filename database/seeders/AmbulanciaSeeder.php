<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ambulancia;

class AmbulanciaSeeder extends Seeder
{
    public function run(): void
    {
        $ambulancias = [
            [
                'nome' => 'Ambulância 1 - Lubango',
                'matricula' => 'LD-01-AMB-E',
                'hospital_id' => 1, // Hospital Geral do Lubango
                'status' => 'Disponível',
                'localizacao' => 'Hospital Geral do Lubango'
            ],
            [
                'nome' => 'Ambulância 2 - Sumbe',
                'matricula' => 'SB-02-AMB-A',
                'hospital_id' => 2, // Hospital Municipal do Sumbe
                'status' => 'Em Atendimento',
                'localizacao' => 'Bairro 4 de Fevereiro, Sumbe'
            ],
            [
                'nome' => 'Ambulância 3 - Caxito',
                'matricula' => 'CX-03-AMB-B',
                'hospital_id' => 3, // Centro de Saúde de Caxito
                'status' => 'Indisponível',
                'localizacao' => 'Garagem Central de Caxito'
            ],
            [
                'nome' => 'Ambulância 4 - Luanda',
                'matricula' => 'LU-04-AMB-C',
                'hospital_id' => 4, // Clínica Esperança
                'status' => 'Disponível',
                'localizacao' => 'Clínica Esperança, Luanda'
            ],
            [
                'nome' => 'Ambulância 5 - Malanje',
                'matricula' => 'MA-05-AMB-D',
                'hospital_id' => 5, // Posto Médico de Malanje
                'status' => 'Indisponível',
                'localizacao' => 'Oficina Central, Malanje'
            ],
        ];

        foreach ($ambulancias as $ambulancia) {
            Ambulancia::create($ambulancia);
        }
    }
}
