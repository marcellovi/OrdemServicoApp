<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddFornecedores extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fornecedores = [
            [ 'id' => 1, 'nome' => 'FEMAQ', 'email' => 'f@femaq.com.br','celular' => '(21) 789-1258','endereco' => 'Botucatu - SP' ],
            [ 'id' => 2, 'nome' => 'FW', 'email' => 'f@fw.com.br','celular' => '(31) 789-1258','endereco' => 'Salvador - BA' ],
            [ 'id' => 3, 'nome' => 'COMPACTION', 'email' => 'f@compaction.com.br','celular' => '(11) 789-1258','endereco' => 'Lauro de Freitas - BA' ],
            [ 'id' => 4, 'nome' => 'BRASILMAQ', 'email' => 'f@brasilmaq.com.br','celular' => '(13) 789-1258','endereco' => 'Santana de Parnaíba - SP' ],
            [ 'id' => 5, 'nome' => 'INSPIRE', 'email' => 'f@inspire.com.br','celular' => '(88) 789-1258','endereco' => 'Blumenau - SC' ],
        ];

        foreach ($fornecedores as $fornecedor) {
            DB::table('fornecedores')->insert($fornecedor);
        }
    }
}
