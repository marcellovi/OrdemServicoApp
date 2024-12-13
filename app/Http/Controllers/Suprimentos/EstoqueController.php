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

    public function edit($produto_id)
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
            DB::table('estoque')->where('produto_id', $id)
                ->update(['quantidade_total' => $request->get('quantidade_total'), 'estoque_local_id' => $request->get('estoque_local_id')]);
        }

        return redirect()->route('almoxarifado.index')
            ->with(['message' => 'Os Dados Produto foram Atualizados no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function produtoSolicitacaoStore(Request $request){

        $is_found = DB::table('os_solicita_produto')->where('ordem_servico_id', $request->get('os_id'))->first();

        if(!empty($is_found)){
            return redirect()->route('gestao.edit', $request->get('os_id'))
                ->with(['message' => 'Já existe uma solicitação registrada no Sistema.',
                    'status' => 'Informativo',
                    'type' => 'info']);
        }

        $itens = implode(' ; ',$request->get('itens'));
        DB::table('os_solicita_produto')->insert([
                'codospedido' => $request->get('codospedido'),
                'itens' => $itens,
                'descritivo' => $request->get('descritivo'),
                'ordem_servico_id' => $request->get('os_id'),
                'prioridade_id' => $request->get('prioridade'),
                'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Current OS status must be updated to 'Em Espera' code 4
        DB::table('ordem_servicos')->where('id',$request->get('os_id'))->update(['status_id' => 4]);

        return redirect()->route('gestao.edit', $request->get('os_id'))
            ->with(['message' => 'Solicitação enviada para o Almoxarifado.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function showSolicitacoes()
    {
        $data = [
            'prioridades' => DB::table('prioridades')->whereNull('deleted_at')->get(),
            'status' => DB::table('status')->whereNull('deleted_at')->get(),
            'estoque' => DB::table('produtos')->whereNull('produtos.deleted_at')
                                    ->select('produtos.nome','quantidade_total','estoque_localizacao.nome as lugar','localizacao')
                                    ->join('estoque','estoque.produto_id','produtos.id')
                                    ->leftjoin('estoque_localizacao','estoque_localizacao.id','estoque_local_id')
                                    ->get(),
        ];
        $solicitacoes = DB::table('os_solicita_produto')->whereNull('deleted_at')->get();

        return view('suprimentos.solicitacoes.os.index', compact('solicitacoes','data'));
    }

    public function editSolicitacoes($id)
    {
        $data = [
            'prioridades' => DB::table('prioridades')->whereNull('deleted_at')->get(),
            'status' => DB::table('status')->whereNull('deleted_at')->get(),
            'estoque' => DB::table('produtos')->whereNull('produtos.deleted_at')
                ->select('produtos.nome','quantidade_total','estoque_localizacao.nome as lugar','localizacao')
                ->join('estoque','estoque.produto_id','produtos.id')
                ->leftjoin('estoque_localizacao','estoque_localizacao.id','estoque_local_id')
                ->get(),

            'produtos' => DB::table('produtos')
                ->join('estoque','estoque.produto_id','produtos.id')
                ->where('quantidade_total','>','0')
                ->whereNull('produtos.deleted_at')->get(),

        ];
        $solicitacao = DB::table('os_solicita_produto')->where('id',$id)->whereNull('deleted_at')->first();

        return view('suprimentos.solicitacoes.os.edit', compact('solicitacao','data'));
    }

    public function saidaEstoqueStore(Request $request)
    {
        foreach($request->get('txt1') as $key => $item){
            DB::table('estoque')->where('produto_id', $item)->decrement('quantidade_total',$request->get('txt2')[$key]);
        }

        return redirect()->route('almoxarifado.solicitacao.show')
            ->with(['message' => 'Solicitação Finalizada! Notificação enviada para o Almoxarifado.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }



}
