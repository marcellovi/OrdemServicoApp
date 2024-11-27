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
            ['id' => 1, 'nome' => 'Cargo 1'],
            ['id' => 2, 'nome' => 'Cargo 2'],
            ['id' => 3, 'nome' => 'Cargo 3'],
        ];

        foreach($cargos as $cargo){
            DB::table('cargos')->insert($cargo);
        }
    }
}
