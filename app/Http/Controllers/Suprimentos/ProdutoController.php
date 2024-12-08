<?php

namespace App\Http\Controllers\Suprimentos;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Fabricante;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index()
    {
        $assets = [
            'categorias' => Categoria::all()->where('deleted_at', '=', null),
            'fabricantes' => Fabricante::all()->where('deleted_at', '=', null),
            'unidade_medida' => DB::table('unidade_medida')->where('deleted_at', '=', null)->get(),
        ];

        $produtos = Produto::all()->where('deleted_at', '=', null);
        return view('suprimentos.produtos.index', compact('assets','produtos'));
    }

    public function store(Request $request){


        $erro = [];
        // Check if codprod is the same
        // ( should I check if there is the same name ? //

//        if(!empty($request->get('sigla'))){

            // T0DO VALIDATION //

//            $is_found = DB::table('ativo_modelo')
//                ->where('sigla', '=', $request->get('sigla'))
//                ->first();
//
                $is_found = Produto::where('codprod', '=', $request->get('codprod'))->first();
                if($is_found){
                    return redirect()->route('produto.index')
                        ->with(['message' => 'O Código do Produto já Existe no Sistema.',
                            'status' => 'Erro',
                            'type' => 'danger']);
                }

             $a = Produto::create([
                'codprod' => strtoupper($request->get('codprod')),
                'nome' => ucfirst($request->get('nome')),
                'categoria_id' => $request->get('categoria_id'),
                'qt_minima' => $request->get('qt_minima'),
                'qt_reposicao' => $request->get('qt_reposicao'),
                'fabricante_id' => $request->get('fabricante_id'),
                'unid_medida_id' => $request->get('unid_medida_id'),
                'descricao' => $request->get('descricao'),
            ]);

            return redirect()->route('produto.index')
                ->with(['message' => 'O Produto '.$request->get('nome').' foi Cadastrado no Sistema.',
                    'status' => 'Sucesso',
                    'type' => 'success']);



//            return redirect()->route('ativos')
//                ->with(['message' => 'O Ativo já Existe no Sistema.',
//                    'status' => 'Erro',
//                    'type' => 'danger']);
//        }
    }

    public function update(Request $request, $id)
    {
//        $request->validate([
//            'title' => 'required|max:255',
//            'body' => 'required',
//        ]);

        $is_found = Produto::where('codprod', '=', $request->get('codprod'))->where('id', '!=', $id)->first();
        if($is_found){
            return redirect()->route('produto.edit',$id)
                ->with(['message' => 'O Código do Produto já Existe no Sistema.',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }

        $produto = Produto::find($id);
        $produto->update([
            'codprod' => strtoupper($request->get('codprod')),
            'nome' => ucfirst($request->get('nome')),
            'categoria_id' => $request->get('categoria_id'),
            'qt_minima' => $request->get('qt_minima'),
            'qt_reposicao' => $request->get('qt_reposicao'),
            'fabricante_id' => $request->get('fabricante_id'),
            'unid_medida_id' => $request->get('unid_medida_id'),
            'descricao' => $request->get('descricao'),
        ]);

            return redirect()->route('produto.index')
                ->with(['message' => 'O Produto '.$request->get('nome').' foi Atualizado no Sistema.',
                    'status' => 'Sucesso',
                    'type' => 'success']);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assets = [
            'categorias' => Categoria::all()->where('deleted_at', '=', null),
            'fabricantes' => Fabricante::all()->where('deleted_at', '=', null),
            'unidade_medida' => DB::table('unidade_medida')->where('deleted_at', '=', null)->get(),
        ];

        $produto = Produto::where('id', '=', $id)->first();

        return view('suprimentos.produtos.edit', compact('produto','assets'));
    }

    public function destroy($id){

        $produto = Produto::find($id);
        $produto->delete();

        return redirect()->route('produto.index')
            ->with(['message' => 'O Produto '.$produto->nome .' foi Excluido do Sistema.',
                'status' => 'Deletado',
                'type' => 'info']);
    }
}
