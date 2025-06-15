<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SetupAdmin extends Command
{
    // Nome do comando no terminal
    protected $signature = 'setup:admin';

    // Descrição do comando
    protected $description = 'Cria um administrador com todas as permissões iniciais';
public function handle()
{
    $this->info('⏳ Criando permissões...');

    $permissoes = [
        'ver_estatisticas',
        'registar_pacientes',
        'editar_todos_pacientes',
        'remover_pacientes',
        'ver_pacientes',
    ];

    foreach ($permissoes as $nome) {
        Permission::firstOrCreate(['name' => $nome]);
    }

    $this->info('✅ Permissões criadas.');

    // 🟩 Roles e permissões atribuídas
    $roles = [
        'Administrador' => $permissoes,
        'Secretario' => ['registar_pacientes', 'ver_pacientes'],
        'Tecnico' => ['editar_todos_pacientes', 'ver_pacientes'],
        'Cliente' => ['ver_pacientes'],
    ];

    foreach ($roles as $roleName => $perms) {
        $role = Role::firstOrCreate(['name' => $roleName]);
        $role->syncPermissions($perms);
        $this->info("✅ Role {$roleName} configurada.");
    }

    // 🧑‍💼 Criar o administrador padrão
    $admin = User::firstOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Administrador',
            'password' => Hash::make('password123')
        ]
    );
    $admin->assignRole('Administrador');
    $this->info('👑 Administrador criado: admin@example.com / password123');

    // 👨🏽‍💼 Criar exemplo de secretário
    $secretario = User::firstOrCreate(
        ['email' => 'secretario@example.com'],
        [
            'name' => 'Secretário',
            'password' => Hash::make('secret123')
        ]
    );
    $secretario->assignRole('Secretario');

    // 👨🏾‍🔧 Criar exemplo de técnico
    $tecnico = User::firstOrCreate(
        ['email' => 'tecnico@example.com'],
        [
            'name' => 'Técnico',
            'password' => Hash::make('tecnico123')
        ]
    );
    $tecnico->assignRole('Tecnico');

    // 👤 Criar exemplo de cliente
    $cliente = User::firstOrCreate(
        ['email' => 'cliente@example.com'],
        [
            'name' => 'Cliente',
            'password' => Hash::make('cliente123')
        ]
    );
    $cliente->assignRole('Cliente');

    $this->info('✅ Outros usuários criados com sucesso!');
}

}
