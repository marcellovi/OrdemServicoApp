<?php

namespace App\Http\Controllers\Suprimentos;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $assets = [
//            'categorias' => Categoria::all()->where('deleted_at', '=', null),
//            'ativos_location' => AtivoLocation::all()->where('deleted_at', '=', null),
//            'ativos_modelo' => DB::table('ativo_modelo')->select('ativo_modelo.id','sigla','ativo_modelo.nome')->distinct()->where('ativo_modelo.deleted_at', '=', null)->join('ativos_itens','ativo_id','ativo_modelo.id')->get(),
//            'ativos_location' => AtivoLocation::all()->where('deleted_at', '=', null),
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
//            if($is_found){
//                return redirect()->route('ativos-itens')
//                    ->with(['message' => 'O Ativo '.$request->get('sigla').' já existe no Sistema.',
//                        'status' => 'Erro',
//                        'type' => 'danger']);
//            }

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

        $ativo = Ativo::find($id);
        // If there are no changes in the location
        if( ($ativo->bloco_id == $request->get('bloco')) &&
            ($ativo->andar_id == $request->get('andar')) &&
            ($ativo->sala_area_id == $request->get('sala_area')) &&
            ($ativo->fase_id == $request->get('fase'))
        ) {
            $ativo_modelo = AtivoModelo::find($request->get('ativo_modelo_id'));
            $ativo_modelo->update([
                'categoria_id' => $request->get('categoria'),
                'modelo' => $request->get('modelo'),
                'serie' => $request->get('serie'),
                'descritivo' => $request->get('descritivo'),
            ]);

            return redirect()->route('ativos')
                ->with(['message' => 'O Ativo '.$request->get('sigla_ativo').' foi Atualizado no Sistema.',
                    'status' => 'Sucesso',
                    'type' => 'success']);
        }else{
            $is_found = DB::table('ativos')
                ->where('bloco_id', '=', $request->get('bloco'))
                ->where('andar_id', '=', $request->get('andar'))
                ->where('sala_area_id', '=', $request->get('sala_area'))
                ->where('fase_id', '=', $request->get('fase'))
                ->where('ativo_modelo_id', '=', $request->get('ativo_modelo_id'))
                ->where('deleted_at', '=', null)
                ->exists();

            if($is_found){
                return redirect()->route('ativos')
                    ->with(['message' => 'O Ativo já Existe no Sistema.',
                        'status' => 'Erro',
                        'type' => 'danger']);
            }

            $tags = AtivoLocation::find($request->get('fase'))->nome.'-'.
                AtivoLocation::find($request->get('bloco'))->nome.'-'.
                AtivoLocation::find($request->get('andar'))->nome.'-'.
                AtivoLocation::find($request->get('sala_area'))->nome.'-'.
                $request->get('sigla_ativo');

            //$ativo = DB::table('ativos')->where('id',$id)->whereNull('deleted_at')->get();
            $ativo = Ativo::find($id);
            $ativo->update([
                'tags' => $tags,
                'bloco_id' => $request->get('bloco'),
                'andar_id' => $request->get('andar'),
                'sala_area_id' => $request->get('sala_area'),
                'fase_id' => $request->get('fase'),
            ]);

            $ativo_modelo = AtivoModelo::find($request->get('ativo_modelo_id'));
            $ativo_modelo->update([
                'categoria_id' => $request->get('categoria'),
                'modelo' => $request->get('modelo'),
                'serie' => $request->get('serie'),
                'descritivo' => $request->get('descritivo'),
            ]);

            return redirect()->route('ativos')
                ->with(['message' => 'O Ativo '.$tags.' foi Atualizado no Sistema.',
                    'status' => 'Sucesso',
                    'type' => 'success']);
        }

        return redirect()->route('ativos')
            ->with(['message' => 'Erro ao atualizar no Sistema.',
                'status' => 'Erro',
                'type' => 'danger']);
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
