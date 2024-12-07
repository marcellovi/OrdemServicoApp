<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddFabricantes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fabricantes = [
            [ 'id' => 1, 'nome' => 'Lagarta', 'email' => 'f@Lagarta.com.br','telefone' => '(21) 789-1258','website' => 'www.Lagarta.com.br' ],
            [ 'id' => 2, 'nome' => 'Komatsu', 'email' => 'f@Komatsu.com.br','telefone' => '(31) 789-1258','website' => 'www.Komatsu.com.br' ],
            [ 'id' => 3, 'nome' => 'Sany', 'email' => 'f@Sany.com.br','telefone' => '(11) 789-1258','website' => 'www.Sany.com.br' ],
            [ 'id' => 4, 'nome' => 'Hitachi', 'email' => 'f@Hitachi.com.br','telefone' => '(13) 789-1258','website' => 'www.Hitachi.com.br' ],
            [ 'id' => 5, 'nome' => 'Deere ', 'email' => 'f@Deere.com.br','telefone' => '(88) 789-1258','website' => 'www.Deere.com.br' ],
        ];

        foreach ($fabricantes as $fabricante) {
            DB::table('fabricantes')->insert($fabricante);
        }
    }
}
