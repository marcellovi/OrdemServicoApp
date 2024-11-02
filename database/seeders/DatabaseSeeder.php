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
            AddBlocos::class,
            AddAndares::class,
            AddSalaAreas::class,
            AddFases::class,
            AddCategories::class,
            AddFakeAtivos::class,
            AddStatues::class,

            ]);
    }
}
