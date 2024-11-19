<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddCategorias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            'Elétrica',
            'Refrigeração',
            'Limpeza',
            'Automação',
            'Arquitetura',
        ];

        foreach($categories  as $category){
            Categoria::create(["nome" => $category]);
        }

    }
}
