<?php

namespace App\Http\Controllers\Suprimentos;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Fabricante;
use App\Models\Produto;
use App\Models\SolicitacaoCompraProduto;
use Illuminate\Support\Facades\DB;

class SolicitacaoCompraProdutoController extends Controller
{
    public function index()
    {
//        $assets = [
//            'categorias' => Categoria::all()->where('deleted_at', '=', null),
//            'fabricantes' => Fabricante::all()->where('deleted_at', '=', null),
//            'status' => DB::table('status')->where('deleted_at', '=', null)->get(),
//        ];
//
//        $solicitacao_compras = SolicitacaoCompraProduto::all()->where('deleted_at', '=', null);
//        return view('suprimentos.solicitacoes.compra.index', compact('assets','solicitacao_compras'));
    }
}
