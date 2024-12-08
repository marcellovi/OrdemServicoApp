<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddEstoqueLocalizacao extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $localizacoes = [
            [ 'id' => 1, 'nome' => 'Armazem I','localizacao' => 'Fase I' ],
            [ 'id' => 2, 'nome' => 'Galpão','localizacao' => 'Proximo ao Bloco 3' ],
            [ 'id' => 3, 'nome' => 'Oficina','localizacao' => 'Dentro do Escritorio' ],
        ];

        foreach ($localizacoes as $localizacao) {
            DB::table('estoque_localizacao')->insert($localizacao);
        }

    }
}
