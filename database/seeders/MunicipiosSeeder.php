<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GabineteMunicipal;
use App\Models\GabineteProvincial;

class MunicipiosSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [
            ['municipio' => 'Caxito', 'provincia_id' => 1],
            ['municipio' => 'Benguela', 'provincia_id' => 2],
            ['municipio' => 'Kuito', 'provincia_id' => 3],
            ['municipio' => 'Cabinda', 'provincia_id' => 4],
            ['municipio' => 'Menongue', 'provincia_id' => 5],
            ['municipio' => 'Ndalatando', 'provincia_id' => 6],
            ['municipio' => 'Sumbe', 'provincia_id' => 7],
            ['municipio' => 'Ondjiva', 'provincia_id' => 8],
            ['municipio' => 'Huambo', 'provincia_id' => 9],
            ['municipio' => 'Lubango', 'provincia_id' => 10],
            ['municipio' => 'Luanda', 'provincia_id' => 11],
            ['municipio' => 'Malanje', 'provincia_id' => 12],
            ['municipio' => 'Luena', 'provincia_id' => 13],
            ['municipio' => 'Moçâmedes', 'provincia_id' => 14],
            ['municipio' => 'Uíge', 'provincia_id' => 15],
            ['municipio' => 'Mbanza Congo', 'provincia_id' => 16],
            ['municipio' => 'Dundo', 'provincia_id' => 33],
            ['municipio' => 'Saurimo', 'provincia_id' => 34],
        ];

        foreach ($dados as $item) {
            // Buscar o gabinete provincial correspondente à província
            $gabineteProvincial = GabineteProvincial::where('provincia_id', $item['provincia_id'])->first();

            if ($gabineteProvincial) {
                GabineteMunicipal::create([
                    'nome' => 'Gabinete Municipal de ' . $item['municipio'],
                    'municipio' => $item['municipio'],
                    'provincia_id' => $item['provincia_id'],
                    'gabinete_provincial_id' => $gabineteProvincial->id,
                ]);
            }
        }
    }
}
