<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AddUsers::class,
            AddCargos::class,
            AddCategorias::class,
            AddEquipes::class,
            AddNaturezaServicos::class,
            AddPrioridades::class,
            AddAtivosLocation::class,
            AddStatues::class,
            AddTipoManutencao::class,
            AddRole::class,
            AddUserRolePermission::class,
            ]);
    }
}
