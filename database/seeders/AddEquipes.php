<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddEquipes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipes = ['Eqp. Elétrica','Eqp. Refrigeração','Eqp. Jardinagem','Eqp. Civil',
            'Eqp. Eng. Clínica','Eqp. Projetista','Eqp. Automação','Eqp. Meio Ambiente',
            'Eqp. Mecânica','Eqp. Bombeiro Gasista','Eqp. Telecomunicação','Eqp. TI',
            'Eqp. Administrativo','Eqp. Transporte','Eqp. Chaveiro','Eqp. Copeira',
            'Eqp. Eletromecânico','Eqp. Arquitetura'
        ];

        foreach($equipes as $equipe){
            DB::table('equipes')->insert(['nome' => $equipe]);
        }
    }
}
