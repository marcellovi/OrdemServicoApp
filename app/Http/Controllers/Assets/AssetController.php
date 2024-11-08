<?php

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use App\Models\Andar;
use App\Models\Artefato;
use App\Models\Ativo;
use App\Models\Bloco;
use App\Models\Categories;
use App\Models\Fase;
use App\Models\SalaArea;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = [
            'categorias' => Categories::all()->where('deleted_at', '=', null),
            'andares' => Andar::all()->where('deleted_at', '=', null),
            'blocos' => Bloco::all()->where('deleted_at', '=', null),
            'fases' => Fase::all()->where('deleted_at', '=', null),
            'sala_areas' => SalaArea::all()->where('deleted_at', '=', null),
            'artefatos' => Artefato::all()->where('deleted_at', '=', null),
        ];

        //$ativos = Ativo::all()->where('deleted_at', '=', null);
        $ativos = Ativo::select('ativos.id','ativos.tags','ativos.name as ativos','ativos.created_at','categories.name as categorias','status.name as status')
            ->join('categories', 'categories.id', '=', 'ativos.category_id')
            ->join('status', 'status.id', '=', 'ativos.status')
            ->where('ativos.deleted_at', '=', null)->orderby('ativos.created_at','desc')->get();
        return view('assets.index', compact('assets','ativos'));
    }

    public function store(Request $request){

//        $request->validate([
//            'categoria' => 'required',
//        ]);

        $tags = Fase::find($request->get('fase'))->name.'-'.
            Bloco::find($request->get('bloco'))->name.'-'.
            Andar::find($request->get('andar'))->name.'-'.
            SalaArea::find($request->get('sala_area'))->name.'-'.
            Fase::find($request->get('fase'))->name.'-'.
            $request->get('nome_ativo');

        Ativo::create([
            'tags' => $tags, // $request->get('tags'),
            'name' => $request->get('nome_ativo'),
            'category_id' => $request->get('categoria'),
            'status' => $request->get('status'),
            'model' => $request->get('modelo'),
            'serie' => $request->get('serie'),
            'bloco_id' => $request->get('bloco'),
            'andar_id' => $request->get('andar'),
            'sala_area_id' => $request->get('sala_area'),
            'fase_id' => $request->get('fase'),
            'descritivo' => $request->get('descritivo'),
        ]);

        return redirect()->route('ativos')
            ->with(['message' => 'O Ativo '.$tags.' foi Cadastrado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function update(Request $request, $id)
    {
//        $request->validate([
//            'title' => 'required|max:255',
//            'body' => 'required',
//        ]);

        $tags = Fase::find($request->get('fase'))->name.'-'.
            Bloco::find($request->get('bloco'))->name.'-'.
            Andar::find($request->get('andar'))->name.'-'.
            SalaArea::find($request->get('sala_area'))->name.'-'.
            Fase::find($request->get('fase'))->name.'-'.
            $request->get('nome_ativo');


        $ativo = Ativo::find($id);
        $ativo->update([
            'tags' => $tags,
            'name' => $request->get('nome_ativo'),
            'category_id' => $request->get('categoria'),
            'model' => $request->get('modelo'),
            'serie' => $request->get('serie'),
            'bloco_id' => $request->get('bloco'),
            'andar_id' => $request->get('andar'),
            'sala_area_id' => $request->get('sala_area'),
            'fase_id' => $request->get('fase'),
            'descritivo' => $request->get('descritivo'),
        ]);
        return redirect()->route('ativos')
            ->with(['message' => 'O Ativo '.$request->get('sigla').' foi Atualizado no Sistema.',
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
            'categorias' => Categories::all()->where('deleted_at', '=', null),
            'andares' => Andar::all()->where('deleted_at', '=', null),
            'blocos' => Bloco::all()->where('deleted_at', '=', null),
            'fases' => Fase::all()->where('deleted_at', '=', null),
            'sala_areas' => SalaArea::all()->where('deleted_at', '=', null),
            'artefatos' => Artefato::all()->where('deleted_at', '=', null),
        ];

        $ativo = Ativo::select('ativos.id','ativos.tags','ativos.name as nome','ativos.model as modelo','ativos.serie as serie',
            'ativos.bloco_id','ativos.andar_id','ativos.sala_area_id','ativos.fase_id','ativos.descritivo as descritivo',
            'categories.name as categorias','categories.id as categoria_id','status.name as status')
            ->join('categories', 'categories.id', '=', 'ativos.category_id')
            ->join('status', 'status.id', '=', 'ativos.status')
            ->where('ativos.deleted_at', '=', null)
            ->where('ativos.id', '=', $id)
            ->orderby('ativos.created_at','desc')->first();

        return view('assets.edit', compact('ativo','assets'));
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

}
