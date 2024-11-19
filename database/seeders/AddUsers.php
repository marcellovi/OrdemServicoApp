<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@demo.com.br',
            'password' => bcrypt('123456789')
        ]);

        User::factory()->create([
            'id' => 2,
            'name' => 'Gerente',
            'email' => 'gerente@demo.com.br',
            'password' => bcrypt('123456789')
        ]);

        User::factory()->create([
            'id' => 3,
            'name' => 'Usuario',
            'email' => 'usuario@demo.com.br',
            'password' => bcrypt('123456789')
        ]);
    }
}
