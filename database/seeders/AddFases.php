<?php

namespace Database\Seeders;

use App\Models\Fase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddFases extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fases = [
            'FS01',
            'FS02',
            'FS03',
            'FS04',
            'FS05',
        ];

        foreach($fases  as $fase){
            Fase::create(["nome" => $fase]);
        }
    }
}
