<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AddPermissao extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard',
            'management',    // gestao os
            'preventive',    // presentiva
            'reports',       // relatorios
            'assets',        // ativos
            'teams',         // equipe
            'transactions'   // Compras
        ];
        foreach ($permissions as $permission) {
          //  Permission::create(['name' => $permission]);
        }
    }
}
