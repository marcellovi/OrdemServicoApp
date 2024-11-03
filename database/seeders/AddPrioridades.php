<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddPrioridades extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prioridades = [
          'Alta','Media','Baixa'
        ];

        foreach ($prioridades as $prioridade) {
            DB::table('prioridades')->insert(['nome' => $prioridade]);
        }
    }
}
