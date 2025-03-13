<?php

namespace App\Http\Controllers\Suprimentos;

use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use sbamtr\LaravelQueryEnrich\QE;
use function sbamtr\LaravelQueryEnrich\c;

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
                    'estoque_local_id' => $request->get('estoque_local_id'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
        }else{
            DB::table('estoque')->where('produto_id', $id)
                ->update(['quantidade_total' => $request->get('quantidade_total'), 'estoque_local_id' => $request->get('estoque_local_id'),'updated_at' => date('Y-m-d H:i:s')]);
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

        $itens = 'Nenhum Item do Ativo foi Selecionado';
        if(!empty($request->get('itens'))){
            $itens = implode(' ; ',$request->get('itens'));
        }
        DB::table('os_solicita_produto')->insert([
                'codospedido' => $request->get('codospedido'),
                'itens' => $itens,
                'descritivo' => $request->get('descritivo'),
                'ordem_servico_id' => $request->get('os_id'),
                'prioridade_id' => $request->get('prioridade'),
                'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Current OS status must be updated to 'Em Espera' code 4  ( alterado agora 10 Aguardando Solicitacao )
        DB::table('ordem_servicos')->where('id',$request->get('os_id'))->update(['status_id' => 10]);

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
        $solicitacoes = DB::table('os_solicita_produto')
            ->whereNull('deleted_at')
            ->whereNot('status_id',5)
            ->get();

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
        $saida = DB::table('item_saida')->select('produtos.nome as nome','solicita_id','quantidade')
            ->join('produtos','item_saida.produto_id','produtos.id')
            ->where('solicita_id',$id)->get();

        return view('suprimentos.solicitacoes.os.edit', compact('solicitacao','data','saida'));
    }

    /**
     * Checa se existe o total solicitado para dar baixa no estoque
     *
     * @param id $id do produto
     * @param quantidade $quantidade disponivel
     * @return boolean true se existe a quatidade solicitada ou false se nao existe
     *
     */
    public function isProdutoIndisponivelEstoque($id, $quantidade){

        $result = false;
        foreach($id as $key => $item){
            $total = DB::table('estoque')
                ->select(  QE::subtract(c('quantidade_total'), $quantidade[$key])->as('qt_total'))
                ->where('produto_id',$item)
                ->first()->qt_total;

            if($total <= 0){
                $result = true;
                break;
            }
        }
        return $result;
    }

    public function saidaEstoqueStore(Request $request)
    {
        if(!empty($request->get('txt1'))){

            foreach($request->get('txt1') as $key => $item){

                // $key == 0 to only run once
                if( $this->isProdutoIndisponivelEstoque($request->get('txt1'), $request->get('txt2')) && $key == 0 ){
                    return redirect()->route('almoxarifado.solicitacao.edit',$request->get('solicitacao_id'))
                        ->with(['message' => 'Não é possivel dar Baixa. Total de produtos acima do estoque. Consultar Estoque!',
                            'status' => 'Erro',
                            'type' => 'danger']);
                }

                DB::table('estoque')->where('produto_id', $item)->decrement('quantidade_total',$request->get('txt2')[$key]);

                DB::table('item_saida')->insert(['solicita_id' => $request->get('solicitacao_id'),
                    'produto_id' => $item,
                    'quantidade' => $request->get('txt2')[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        // Solicitacao Status Changed to - Fechada
        DB::table('os_solicita_produto')->where('id',$request->get('solicitacao_id'))->update(['status_id' => 5,'comentario_estoque' => $request->get('comentario_estoque')]); // Codigo de Fechamento

        // Ordem Servico Status Changed to - Solicitacao Finalizada
        DB::table('ordem_servicos')->where('id',$request->get('os_id'))->update(['status_id' => 11]);

        // CREATE NOTIFICACAO AO USUARIO RESPONSAVEL PELO SOLICITACAO DA OS
        Notificacao::create([
            'fromUserId' => Auth::user()->id,
            'toUserId' =>  Auth::user()->id,
            'message' => 'Produto(s) pronto para Buscar! OS N. '.$request->get('numero_os'),
            'status_id' => 2,
            'prioridade_id' => 2,
            //'created_at' => $request->get('descritivo'),
        ]);

        return redirect()->route('almoxarifado.solicitacao.show')
            ->with(['message' => 'Solicitação Finalizada! Notificação enviada para o Almoxarifado.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function entradaEstoqueStore(Request $request)
    {
        if(!empty($request->get('txt1'))){

            foreach($request->get('txt1') as $key => $item){
                DB::table('estoque')->where('produto_id', $item)->decrement('quantidade_total',$request->get('txt2')[$key]);

                DB::table('item_saida')->insert(['solicita_id' => $request->get('solicitacao_id'),
                    'produto_id' => $item,
                    'quantidade' => $request->get('txt2')[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        DB::table('os_solicita_produto')->where('id',$request->get('solicitacao_id'))->update(['status_id' => 5,'comentario_estoque' => $request->get('comentario_estoque')]); // Codigo de Fechamento

        // TODO SEND NOTIFICACAO AO USUARIO RESPONSAVEL PELO SOLICITACAO DA OS

        return redirect()->route('almoxarifado.solicitacao.show')
            ->with(['message' => 'Solicitação Finalizada! Notificação enviada para o Almoxarifado.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }



}
