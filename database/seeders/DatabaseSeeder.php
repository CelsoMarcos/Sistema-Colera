<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
 
    public function run()
{
    $this->call([
        PermissoesSeeder::class,
    ]);
    $this->call([
    GabinetesProvinciaisSeeder::class,
]);
$this->call([
    ProvinciaSeeder::class,
    GabineteProvincialSeeder::class,
    MunicipiosSeeder::class,
    HospitalSeeder::class,
    AmbulanciaSeeder::class,
]);

}

}
