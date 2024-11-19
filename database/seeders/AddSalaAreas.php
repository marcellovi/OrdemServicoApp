<?php

namespace Database\Seeders;

use App\Models\SalaArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddSalaAreas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sala_areas = [
            'SL01',
            'SL02',
            'SL03',
            'SL04',
            'SL05',
        ];

        foreach($sala_areas  as $sala_area){
            SalaArea::create(["nome" => $sala_area]);
        }
    }
}
