<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddTipoManutencao extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo_manutencao = ['Corretiva','Corretiva Programada','Preditiva','Emergencial',
            'Preventiva Manual','Melhoria','Remanejamento','Instalação','Eventual'
        ];

        foreach($tipo_manutencao as $manutencao){
            DB::table('tipo_manutencao')->insert(['nome' => $manutencao]);
        }
    }
}
