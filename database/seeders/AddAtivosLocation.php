<?php

namespace Database\Seeders;

use App\Models\AtivoLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddAtivosLocation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $andares = ['AND01','AND02','AND03','AND04','AND05'];
        $blocos = ['BL01','BL02','BL03','BL04','BL05'];
        $fases = ['FS01','FS02','FS03','FS04','FS05'];
        $sala_areas = ['SL01','SL02','SL03','SL04','SL05'];

        foreach($fases  as $fase){
            AtivoLocation::create(["nome" => $fase,"tipo" => 'fase']);
        }

        foreach($blocos  as $bloco){
            AtivoLocation::create(["nome" => $bloco,"tipo" => 'bloco']);
        }

        foreach($andares  as $andar){
            AtivoLocation::create(["nome" => $andar,"tipo" => 'andar']);
        }

        foreach($sala_areas  as $sala_area){
            AtivoLocation::create(["nome" => $sala_area,"tipo" => 'sala_area']);
        }


    }
}
