<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersWithRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar roles
    $adminRole = Role::create(['name' => 'admin_sistema']);
    $medicoRole = Role::create(['name' => 'medico']);
    
    // Criar permissões
    Permission::create(['name' => 'gerenciar_pacientes']);
    
    // Atribuir permissões
    $adminRole->givePermissionTo('gerenciar_pacientes');
    $medicoRole->givePermissionTo('gerenciar_pacientes');

    // Criar usuários
    $admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@saude.gov.ao',
        'password' => bcrypt('senha123')
    ]);
    $admin->assignRole('admin_sistema');

    $medico = User::create([
        'name' => 'Dr. Silva',
        'email' => 'medico@saude.gov.ao',
        'password' => bcrypt('senha123')
    ]);
    $medico->assignRole('medico');

    }
}
