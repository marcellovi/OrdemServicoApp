<?php

namespace App\Http\Controllers\Ativos;

use App\Http\Controllers\Controller;
use App\Models\Andar;
use App\Models\Artefato;
use App\Models\Ativo;
use App\Models\AtivoLocation;
use App\Models\AtivoModelo;
use App\Models\Bloco;
use App\Models\Categoria;
use App\Models\Categories;
use App\Models\Fase;
use App\Models\Item;
use App\Models\ItemAtivo;
use App\Models\NaturezaServico;
use App\Models\SalaArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AtivoController extends Controller
{

    /********* ATIVOS  *********/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = [
            'categorias' => Categoria::all()->where('deleted_at', '=', null),
            'ativos_location' => AtivoLocation::all()->where('deleted_at', '=', null),
            'ativos_modelo' => DB::table('ativo_modelo')->select('ativo_modelo.id','sigla','ativo_modelo.nome')->distinct()->where('ativo_modelo.deleted_at', '=', null)->join('ativos_itens','ativo_id','ativo_modelo.id')->get(),
            'ativos_location' => AtivoLocation::all()->where('deleted_at', '=', null),
        ];

        $ativos = Ativo::all()->where('deleted_at', '=', null);
//            ->join('categorias', 'categorias.id', '=', 'ativos.category_id')
//            ->join('status', 'status.id', '=', 'ativos.status')
//            ->where('ativos.deleted_at', '=', null)->orderby('ativos.created_at','desc')->get();
        return view('ativos.index', compact('assets','ativos'));
    }

    public function store(Request $request){

        if(!empty($request->get('sigla'))){

            // T0DO VALIDATION //

            $is_found = DB::table('ativo_modelo')
                ->where('sigla', '=', $request->get('sigla'))
                ->first();

            if($is_found){
                return redirect()->route('ativos-itens')
                    ->with(['message' => 'O Ativo '.$request->get('sigla').' já existe no Sistema.',
                        'status' => 'Erro',
                        'type' => 'danger']);
            }

            AtivoModelo::create([
                'sigla' => strtoupper($request->get('sigla')),
                'nome' => ucfirst($request->get('nome')),
                'categoria_id' => $request->get('categoria'),
                'modelo' => $request->get('modelo'),
                'serie' => $request->get('serie'),
                'descritivo' => $request->get('descritivo'),
            ]);

            return redirect()->route('ativos-itens')
                ->with(['message' => 'O Ativo '.$request->get('sigla').' foi Cadastrado no Sistema.',
                    'status' => 'Sucesso',
                    'type' => 'success']);

        }else{

            /** Check if already exists */
            $is_found = DB::table('ativos')
                ->where('bloco_id', '=', $request->get('bloco'))
                ->where('andar_id', '=', $request->get('andar'))
                ->where('sala_area_id', '=', $request->get('sala_area'))
                ->where('fase_id', '=', $request->get('fase'))
                ->where('ativo_modelo_id', '=', $request->get('ativo_modelo'))
                ->where('deleted_at', '=', null)
                ->exists();
            if(!$is_found){
                $tags = AtivoLocation::find($request->get('fase'))->nome.'-'.
                    AtivoLocation::find($request->get('bloco'))->nome.'-'.
                    AtivoLocation::find($request->get('andar'))->nome.'-'.
                    AtivoLocation::find($request->get('sala_area'))->nome.'-'.
                    AtivoModelo::find($request->get('ativo_modelo'))->sigla;

                Ativo::create([
                    'tags' => strtoupper($tags), // $request->get('tags'),
                    'ativo_modelo_id' => $request->get('ativo_modelo'),
                    'bloco_id' => $request->get('bloco'),
                    'andar_id' => $request->get('andar'),
                    'sala_area_id' => $request->get('sala_area'),
                    'fase_id' => $request->get('fase'),
                ]);

                return redirect()->route('ativos')
                    ->with(['message' => 'O Ativo '.$tags.' foi Cadastrado no Sistema.',
                        'status' => 'Sucesso',
                        'type' => 'success']);
            }

            return redirect()->route('ativos')
                ->with(['message' => 'O Ativo já Existe no Sistema.',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }
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
            'ativos_location' => AtivoLocation::all()->where('deleted_at', '=', null),
        ];

        $ativo = Ativo::select('ativos.id','ativos.tags', 'ativos.bloco_id','ativos.andar_id','ativos.sala_area_id','ativos.fase_id','ativo_modelo_id',
            'ativo_modelo.sigla','ativo_modelo.nome','ativo_modelo.modelo','ativo_modelo.serie','ativo_modelo.descritivo','ativo_modelo.categoria_id')
            ->join('ativo_modelo', 'ativo_modelo.id', '=', 'ativos.ativo_modelo_id')
            ->join('categorias', 'categorias.id', '=', 'ativo_modelo.categoria_id')
            ->where('ativos.deleted_at', '=', null)
            ->where('ativos.id', '=', $id)
            ->first();

        return view('ativos.edit', compact('ativo','assets'));
    }

    public function destroy($id){

        $ativo = Ativo::find($id);
        $tags  = $ativo->tags;
        $ativo->delete();

        return redirect()->route('ativos')
            ->with(['message' => 'O Ativo '.$tags .' foi Excluido do Sistema.',
                'status' => 'Deletado',
                'type' => 'info']);
    }


    /********* LINK ATIVOS ITENS  *********/
    public function linkAtivosItens()
    {
        $itens = DB::table('itens')
                    ->select('itens.nome as item_nome', 'itens.id as item_id',
                        'natureza_servicos.nome as categoria_nome','natureza_servicos.id as categoria_id')
                    ->where('itens.deleted_at', '=', null)
                    ->join('natureza_servicos','categoria_id','natureza_servicos.id')
                    ->orderby('natureza_servicos.nome','asc')
                    ->get()
                    ->groupby(function($item) {
                        return $item->categoria_nome;
                    });

        $ativosModeloItens = DB::table('ativo_modelo')
            ->select('ativo_modelo.id as ativo_modelo_id','ativo_modelo.*',
                    'ativos_itens.*')
            ->where('ativo_modelo.deleted_at', '=', null)
            ->leftjoin('ativos_itens','ativo_id','ativo_modelo.id')
            ->orderby('ativo_modelo_id')
            ->get();

        $listItens = Item::all()->where('deleted_at', '=', null);
        return view('ativos.ativos_item.link', compact('itens','ativosModeloItens','listItens'));
    }

    public function ativosItens()
    {
//        $a = DB::table('ativo_modelo')
//            ->select('ativo_modelo.id as ativo_modelo_id','ativo_modelo.*',
//                'ativos_itens.*')
//            ->where('ativo_modelo.deleted_at', '=', null)
//            ->leftjoin('ativos_itens','ativo_id','ativo_modelo.id')
//            ->orderby('ativo_modelo_id')
//            ->get();

        $categorias = NaturezaServico::all()->where('deleted_at', '=', null);
        $itens = Item::all()->where('deleted_at', '=', null);
//        $ativos_modelos = DB::table('ativo_modelo')
//                            ->select('ativo_modelo.id as ativo_modelo_id','ativo_modelo.nome as ativo_modelo_nome',
//                            'ativo_modelo.id as ativo_modelo_id','ativo_modelo.*','ativo_id','item_id')
//                            ->where('ativo_modelo.deleted_at', '=', null)
//                            ->leftjoin('ativos_itens','ativo_id','ativo_modelo.id')
//                            ->orderby('ativo_modelo_id')
//                            ->get();

        $ativos_modelos = AtivoModelo::all()->where('deleted_at', '=', null);

        return view('ativos.ativos_item.index', compact('categorias','ativos_modelos','itens'));
    }

    public function linkStoreAtivoItems(Request $request){


        $itens = $request->get('itens');
        $ativo = $request->get('ativo');
        $action = '';
        foreach($itens as $item){

            if($request->get('btnsubmit') == 'remover'){


                DB::table('ativos_itens')->where('ativo_id', $ativo)->where('item_id', $item)->delete();
            }else{
                $action = 'Linkado';
                $is_found = DB::table('ativos_itens')->where('ativo_id', $ativo)->where('item_id', $item)->first();

                if(!$is_found){
                    DB::table('ativos_itens')->insert(['ativo_id' => $ativo, 'item_id' => $item,'created_at' => date('Y-m-d H:i:s')]);
                }
            }
        }


//        $url = $this->red->getUrlGenerator();
//        return $url->previous() . '#profileIcon';
//
//            return Redirect::to(URL::previous() . "#ativos-itens");


        return redirect()->route('link-ativos-itens')
            ->with(['message' => $action.' com Successo no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
            //->withFragment('#profileIcon'); // adds anchor to the URL


    }

    public function storeItem(Request $request){

            Item::create([
                'nome' => ucfirst($request->get('nome')),
                'categoria_id' => $request->get('categoria'),
                'modelo' => $request->get('modelo'),
                'descritivo' => $request->get('descritivo'),
            ]);

//        $url = $this->red->getUrlGenerator();
//        return $url->previous() . '#profileIcon';
//
//            return Redirect::to(URL::previous() . "#ativos-itens");

            return redirect()->route('ativos-itens')
                ->with(['message' => 'O Item '.$request->get('nome').' foi Cadastrado no Sistema.',
                    'status' => 'Sucesso',
                    'type' => 'success'])
                ->withFragment('#profileIcon'); // adds anchor to the URL


    }




}
