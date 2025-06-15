<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class PermissoesSeeder extends Seeder
{
    public function run()
    {
        // Lista de permissões
        $permissoes = [
            'ver_estatisticas',
            'registar_pacientes',
            'editar_todos_pacientes'
        ];

        // Criar as permissões (se ainda não existirem)
        foreach ($permissoes as $permissao) {
            Permission::firstOrCreate(['name' => $permissao]);
        }

        // Criar um usuário administrador padrão
        $admin = User::firstOrCreate(
            ['email' => 'admin@sistemacolera.test'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123')
            ]
        );

        // Atribuir todas as permissões ao usuário
        $admin->givePermissionTo($permissoes);

        $this->command->info('Usuário administrador criado com sucesso!');
    }
}
