<?php

namespace Database\Seeders;

use App\Models\Ativo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddFakeAtivos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Ativo::create([
            "tags" => "FS01-BL01-AND01-SL01-AB01",
            "name" => "AB01",
            "bloco_id" => 1,
            "andar_id" => 1,
            "sala_area_id" => 1,
            "fase_id" => 1,
            "category_id" => 1,
            "status" => 4,
        ]);

        Ativo::create([
            "tags" => "FS01-BL03-AND02-SL03-AC01",
            "name" => "AC01",
            "bloco_id" => 3,
            "andar_id" => 2,
            "sala_area_id" => 3,
            "fase_id" => 1,
            "category_id" => 3,
            "status" => 2
        ]);

        Ativo::create([
            "tags" => "FS02-BL02-AND02-SL02-AC02",
            "name" => "AC02",
            "bloco_id" => 2,
            "andar_id" => 2,
            "sala_area_id" => 2,
            "fase_id" => 2,
            "model" => "model test AC02",
            "serie" => "serie test AC02",
            "descritivo" => "This is a Test AC02",
            "category_id" => 2,
            "status" => 3
        ]);
    }
}
