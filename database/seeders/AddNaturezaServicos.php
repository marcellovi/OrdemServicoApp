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
//        $natureza_servicos = ['Elétrica','Refrigeração','Jardinagem','Limpeza',
//            'Civil','Eng. Clínica','Projetista','Automação','Meio Ambiente',
//            'Hidráulica ','Alvenaria ','Mecânica','Bombeiro Gasista',
//            'Telecomunicação','TI','Administrativo','Transporte','Chaveiro','Copeira',
//            'Eletromecânico','Arquitetura'
//        ];

        $natureza_servicos = ['Elétrica','Refrigeração','Civil','Automação','Mecânica'];

        foreach($natureza_servicos as $natureza_servico){
            DB::table('natureza_servicos')->insert(['nome' => $natureza_servico]);
        }
    }
}
