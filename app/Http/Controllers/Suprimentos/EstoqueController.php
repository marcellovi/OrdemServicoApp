<?php

namespace App\Http\Controllers\Suprimentos;

use App\Http\Controllers\Controller;
use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller
{
    public function index()
    {
        $produtos = DB::table('produtos')
                        ->select('codprod','produtos.id','quantidade_total','produtos.nome as produto','qt_minima',
                                'qt_reposicao','estoque_localizacao.nome as nome_localizacao','localizacao')
                        ->where('produtos.deleted_at', '=', null)
                        ->leftjoin('estoque','estoque.produto_id','=','produtos.id')
                        ->leftjoin('estoque_localizacao','estoque.estoque_local_id','=','estoque_localizacao.id')
                        ->get();
        return view('suprimentos.almoxarifado.index', compact('produtos'));
    }

    public function edit($produto_id, $localizacao_id)
    {
        $localizacao = DB::table('estoque_localizacao')->whereNull('estoque_localizacao.deleted_at')->get();

        $produto = DB::table('produtos')
            ->select('codprod','produtos.id','quantidade_total','produtos.nome as produto','qt_minima',
                'qt_reposicao','estoque_localizacao.nome as nome_localizacao','localizacao','estoque_localizacao.id as localizacao_id')
            ->where('produtos.deleted_at', '=', null)
            ->leftjoin('estoque','estoque.produto_id','=','produtos.id')
            ->leftjoin('estoque_localizacao','estoque.estoque_local_id','=','estoque_localizacao.id')
            ->where('produtos.id', '=', $produto_id)
            ->first();

        return view('suprimentos.almoxarifado.edit', compact('produto','localizacao'));
    }

    public function update(Request $request, $id)
    {
//        $request->validate([
//            'title' => 'required|max:255',
//            'body' => 'required',
//        ]);

        DB::table('produtos')->where('id', $id)->update(['qt_minima' => $request->get('qt_minima'), 'qt_reposicao' => $request->get('qt_reposicao')]);
        $is_found = DB::table('estoque')->where('produto_id', $id)->first();

        if(!$is_found){
            DB::table('estoque')
                ->insert([
                    'produto_id' => $id,
                    'quantidade_total' => $request->get('quantidade_total'),
                    'estoque_local_id' => $request->get('estoque_local_id')
                ]);
        }else{
            DB::table('estoque')->where('product_id', $id)
                ->update(['quantidade_total' => $request->get('quantidade_total'), 'estoque_local_id' => $request->get('estoque_local_id')]);
        }

        return redirect()->route('almoxarifado.index')
            ->with(['message' => 'Os Dados Produto foram Atualizados no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }
}
