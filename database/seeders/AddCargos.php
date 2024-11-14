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
            'Cargo 1',
            'Cargo 2',
            'Cargo 3',
        ];

        foreach($cargos as $cargo){
            DB::table('cargos')->insert(['nome' => $cargo]);
        }
    }
}
