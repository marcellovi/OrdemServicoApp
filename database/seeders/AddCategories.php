<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddCategories extends Seeder
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
            Categories::create(["name" => $category]);
        }

    }
}
