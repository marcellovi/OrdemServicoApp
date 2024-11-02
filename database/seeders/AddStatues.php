<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddStatues extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statues = ['Em Analise','Aberta','Em Andamento', 'Em Espera','Fechada'];

        foreach ($statues as $status) {
            DB::table('status')->insert(['name' => $status]);
        }
    }
}
