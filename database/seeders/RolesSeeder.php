<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // Roles principais
    $roles = [
        'admin_sistema',
        'gestor_provincial',
        'medico',
        'tecnico_saude'
    ];
    
    foreach ($roles as $role) {
        Role::create(['name' => $role]);
    }

    // Permissões específicas
    Permission::create(['name' => 'registar_pacientes']);
    Permission::create(['name' => 'editar_todos_pacientes']);
    Permission::create(['name' => 'acesso_dashboard']);
    
    // Atribuir permissões a roles
    $admin = Role::findByName('admin_sistema');
    $admin->givePermissionTo(Permission::all());
}
}
