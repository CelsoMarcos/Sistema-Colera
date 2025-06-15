<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GabineteProvincial;
use App\Models\Provincia;

class GabinetesProvinciaisSeeder extends Seeder
{
    public function run(): void
    {
        // Evita duplicações
        if (GabineteProvincial::count() > 0) {
            $this->command->warn('Gabinetes Provinciais já foram criados.');
            return;
        }

        // Para cada província existente, cria um gabinete
        Provincia::all()->each(function ($provincia) {
            GabineteProvincial::create([
                'nome' => 'Gabinete de ' . $provincia->nome,
                'provincia_id' => $provincia->id,
            ]);
        });

        $this->command->info('✅ Gabinetes Provinciais criados com sucesso!');
    }
}
