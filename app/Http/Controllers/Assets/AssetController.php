<?php

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use App\Models\Andar;
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
            'sala_areas' => SalaArea::all()->where('deleted_at', '=', null)
        ];

        // put order by
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
            'model' => $request->get('model'),
            'serie' => $request->get('serie'),
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
