<?php

namespace App\Http\Controllers\Ativos;

use App\Http\Controllers\Controller;
use App\Models\ItemAtivo;
use Illuminate\Http\Request;

class ItemAtivoController extends Controller
{
    public function index(){
        $item_ativos = Artefato::all()->whereNull('deleted_at');
        return view('item_ativos.index')->with('item_ativos', $item_ativos);
    }

    public function store(Request $request){

//        $request->validate([
//            'nome' => 'required|max:25',
//            'nome' => 'required',
//        ]);

        $item_ativo = ItemAtivo::where('nome', $request->get('nome'))->first();

        if(!empty($item_ativo)){
            return redirect()->route('item_ativos')
                ->with(['message' => 'O Artefato '.$request->get('nome') .' Já Existe no Sistema.',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }

        ItemAtivo::create($request->all());
        return redirect()->route('item_ativos')
            ->with(['message' => 'O Artefato '.$request->get('nome').' foi Cadastrado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $item_ativo = ItemAtivo::find($id);
        $item_ativo->update($request->all());
        return redirect()->route('item_ativos')
            ->with(['message' => 'O Artefato '.$request->get('nome').' foi Atualizado no Sistema.',
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
        $item_ativo = ItemAtivo::find($id);
        $item_ativos = ItemAtivo::all()->whereNull('deleted_at');
        return view('item_ativos.edit', compact('artefato','item_ativos'));
    }

    public function destroy($id){

        $item_ativo = ItemAtivo::find($id);

        // Verifica se existe algum referencia "filho" deste artefato associado
        $found = ItemAtivo::where('sub_artefato_id',$item_ativo->id)->first();

        if(!empty($found)){
            return redirect()->route('item_ativos')
                ->with(['message' => 'Existe Artefato(s) Filhos do Artefato "'.strtoupper($item_ativo->nome).'". Delete-os antes de Deletar este Artefato.',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }
        $item_ativo->delete();

        return redirect()->route('item_ativos')
            ->with(['message' => 'O Artefato '.$item_ativo->nome .' foi Excluido do Sistema.',
                'status' => 'Deletado',
                'type' => 'info']);
    }
}
