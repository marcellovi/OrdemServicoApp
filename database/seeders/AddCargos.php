<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddCargos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cargos = [
            'Analista de Manutenção',
            'Analista de Meio Ambiente',
            'Analista de Projetos',
            'Analista de Sistemas',
            'Auxiliar de limpeza',
            'Engenheiro Automação',
            'Mestre de obras',
            'Técnico em Refrigeração',
            'Técnico em Mecânica',
            'Servente',
            'Outros',
        ];

        foreach($cargos as $cargo){
            DB::table('cargos')->insert(['nome' => $cargo]);
        }
    }
}
