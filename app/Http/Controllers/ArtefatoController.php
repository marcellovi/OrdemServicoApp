<?php

namespace App\Http\Controllers;

use App\Models\Artefato;
use Illuminate\Http\Request;

class ArtefatoController extends Controller
{
    public function index(){
        $artefatos = Artefato::all()->whereNull('deleted_at');
        return view('artefatos.index')->with('artefatos', $artefatos);
    }

    public function store(Request $request){

//        $request->validate([
//            'sigla' => 'required|max:25',
//            'nome' => 'required',
//        ]);
echo $request->get('sigla');
        $artefato = Artefato::where('sigla', $request->get('sigla'))->first();

        if(!empty($artefato)){
            return redirect()->route('artefatos')
                ->with(['message' => 'O Artefato '.$request->get('sigla') .' Já Existe no Sistema.',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }

        Artefato::create($request->all());
        return redirect()->route('artefatos')
            ->with(['message' => 'O Artefato '.$request->get('sigla').' foi Cadastrado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function destroy($id){

        $artefato = Artefato::find($id);
        $sigla  = $artefato->sigla;
        $artefato->delete();

        return redirect()->route('artefatos')
            ->with(['message' => 'O Artefato '.$sigla .' foi Excluido do Sistema.',
                'status' => 'Deletado',
                'type' => 'info']);
    }
}
