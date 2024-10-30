<?php

namespace Database\Seeders;

use App\Models\Bloco;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddBlocos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blocos = [
            'BL01',
            'BL02',
            'BL03',
            'BL04',
            'BL05',
        ];

        foreach($blocos  as $bloco){
            Bloco::create(["name" => $bloco]);
        }
    }
}
