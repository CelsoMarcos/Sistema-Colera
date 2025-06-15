<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provincia;



class ProvinciasSeeder extends Seeder
{
    public function run()
    {
        $provincias = [
            'Luanda', 'Bengo', 'Benguela', 'Bié', 'Cabinda',
            'Cuando Cubango', 'Cuanza Norte', 'Cuanza Sul',
            'Cunene', 'Huambo', 'Huíla', 'Malanje', 'Moxico',
            'Namibe', 'Uíge', 'Zaire'
        ];

        foreach ($provincias as $nome) {
            Provincia::create(['nome' => $nome]);
        }
    }
}