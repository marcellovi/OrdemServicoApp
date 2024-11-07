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

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $artefato = Artefato::find($id);
        $artefato->update($request->all());
        return redirect()->route('artefatos')
            ->with(['message' => 'O Artefato '.$request->get('sigla').' foi Atualizado no Sistema.',
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
        $artefato = Artefato::find($id);
        $artefatos = Artefato::all()->whereNull('deleted_at');
        return view('artefatos.edit', compact('artefato','artefatos'));
    }

    public function destroy($id){

        $artefato = Artefato::find($id);

        // Verifica se existe algum referencia "filho" deste artefato associado
        $found = Artefato::where('sub_artefato_id',$artefato->id)->first();

        if(!empty($found)){
                return redirect()->route('artefatos')
                    ->with(['message' => 'Existe Artefato(s) Filhos do Artefato "'.strtoupper($artefato->sigla).'". Delete-os antes de Deletar este Artefato.',
                        'status' => 'Erro',
                        'type' => 'danger']);
        }
        $artefato->delete();

        return redirect()->route('artefatos')
            ->with(['message' => 'O Artefato '.$artefato->sigla .' foi Excluido do Sistema.',
                'status' => 'Deletado',
                'type' => 'info']);
    }
}
