<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddStatues extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statues_os = [
            [ 'id' => 1, 'nome' => 'Em Analise','tipo_status' => 'os' ],
            [ 'id' => 2, 'nome' => 'Aberta','tipo_status' => 'os' ],
            [ 'id' => 3, 'nome' => 'Em Andamento','tipo_status' => 'os' ],
            [ 'id' => 4, 'nome' => 'Em Espera','tipo_status' => 'os' ],
            [ 'id' => 5, 'nome' => 'Fechada','tipo_status' => 'os'],
        ];
        $statues_rh = [
            [ 'id' => 7, 'nome' => 'Ativo','tipo_status' => 'rh' ],
            [ 'id' => 8, 'nome' => 'Em Férias','tipo_status' => 'rh' ],
            [ 'id' => 9, 'nome' => 'Demitido','tipo_status' => 'rh' ],
        ];

        $statues_sc = [
            [ 'id' => 10, 'nome' => 'Aguardando Solicitação','tipo_status' => 'sc' ],
            [ 'id' => 11, 'nome' => 'Solicitação Finalizada','tipo_status' => 'sc' ],
            [ 'id' => 12, 'nome' => 'Aguardando Compra','tipo_status' => 'sc' ],
            [ 'id' => 13, 'nome' => 'Compra Finalizada','tipo_status' => 'sc' ],
        ];

        foreach ($statues_os as $status) {
            DB::table('status')->insert($status);
        }

        foreach ($statues_rh as $status_rh) {
            DB::table('status')->insert($status_rh);
        }
        foreach ($statues_sc as $status_sc) {
            DB::table('status')->insert($status_sc);
        }
    }
}
