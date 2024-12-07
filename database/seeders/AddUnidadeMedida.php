<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddUnidadeMedida extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unid_medidas = [
            [ 'id' => 1, 'sigla' => 'km', 'nome' => 'Quilômetro','valor' => 1000,'medida' => 'comprimento' ],
            [ 'id' => 2, 'sigla' => 'm', 'nome' => 'Metro','valor' => 1,'medida' => 'comprimento' ],
            [ 'id' => 3, 'sigla' => 'cm', 'nome' => 'Centimetro','valor' => 0.01,'medida' => 'comprimento' ],
            [ 'id' => 4, 'sigla' => 'mm', 'nome' => 'Milimetro','valor' => 0.001,'medida' => 'comprimento' ],
            [ 'id' => 5, 'sigla' => 'l', 'nome' => 'Litro','valor' => 1,'medida' => 'capacidade' ],
            [ 'id' => 6, 'sigla' => 'ml', 'nome' => 'Mililitro','valor' => 0.001,'medida' => 'capacidade' ],
            [ 'id' => 7, 'sigla' => 'kg', 'nome' => 'Quilograma','valor' => 1000,'medida' => 'massa' ],
            [ 'id' => 8, 'sigla' => 'g', 'nome' => 'Grama','valor' => 1,'medida' => 'massa' ],
            [ 'id' => 9, 'sigla' => 'mg', 'nome' => 'Miligrama','valor' => 0.001,'medida' => 'massa' ],
            [ 'id' => 10, 'sigla' => 'km3', 'nome' => 'Quilômetro Cubico','valor' => 1000,'medida' => 'volume' ],
            [ 'id' => 11, 'sigla' => 'm3', 'nome' => 'Metro Cubico','valor' => 1,'medida' => 'volume' ],
            [ 'id' => 12, 'sigla' => 'cm3', 'nome' => 'Centimetro Cubico','valor' => 0.01,'medida' => 'volume' ],
            [ 'id' => 13, 'sigla' => 'mm3', 'nome' => 'Milimetro Cubico','valor' => 0.001,'medida' => 'volume' ],

        ];

        foreach ($unid_medidas as $unid_medida) {
            DB::table('unidade_medida')->insert($unid_medida);
        }
    }
}
