<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AddRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'Administrador'],            // gestao os
            ['id' => 2, 'name' => 'Gerente'],            // gestao os
            ['id' => 3, 'name' => 'Usuario'],            // gestao os
        ];

        foreach($roles  as $role){
            Role::create($role);
        }
    }
}
