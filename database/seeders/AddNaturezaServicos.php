<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddNaturezaServicos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $natureza_servicos = ['Elétrica','Refrigeração','Jardinagem','Civil',
            'Eng. Clínica','Projetista','Automação','Meio Ambiente',
            'Mecânica','Bombeiro Gasista','Telecomunicação','TI',
            'Administrativo','Transporte','Chaveiro','Copeira',
            'Eletromecânico','Arquitetura'
        ];

        foreach($natureza_servicos as $natureza_servico){
            DB::table('natureza_servicos')->insert(['nome' => $natureza_servico]);
        }
    }
}
