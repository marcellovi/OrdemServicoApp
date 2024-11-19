<?php

namespace Database\Seeders;

use App\Models\Andar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddAndares extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $andares = [
            'AND01',
            'AND02',
            'AND03',
            'AND04',
            'AND05',
        ];

        foreach($andares  as $andar){
            Andar::create(["nome" => $andar]);
        }
    }
}
