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
          ['id' => 1, 'nome' => 'Emergencial', 'tempo_limite' => 1],
          ['id' => 2, 'nome' => 'Alta', 'tempo_limite' => 2],
          ['id' => 3, 'nome' => 'Media', 'tempo_limite' => 2],
          ['id' => 4, 'nome' => 'Baixa', 'tempo_limite' => 3],
        ];

        foreach ($prioridades as $prioridade) {
            DB::table('prioridades')->insert($prioridade);
        }
    }
}
