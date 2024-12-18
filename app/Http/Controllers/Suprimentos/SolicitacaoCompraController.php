<?php

namespace App\Http\Controllers\Suprimentos;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Fabricante;
use App\Models\Produto;
use App\Models\SolicitacaoCompra;
use App\Models\SolicitacaoCompraProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitacaoCompraController extends Controller
{
    public function index()
    {
        $produtos = Produto::all()->where('deleted_at', '=', null);
        $prioridades =  DB::table('prioridades')->where('deleted_at', '=', null)->get();
        $codigo_solicitacao_compra = 'SC-'.date('YmdHis');
        return view('suprimentos.solicitacoes.compra.index', compact('produtos','prioridades','codigo_solicitacao_compra'));
    }

    public function create($id)
    {
        $produtos = Produto::all()->where('deleted_at', '=', null);
        $prioridades =  DB::table('prioridades')->where('deleted_at', '=', null)->get();
        $os_solicita_produto_id = $id;
        $codigo_solicitacao_compra = 'SO-'.DB::table('os_solicita_produto')->where('id','=',$id)->first()->codospedido;

        return view('suprimentos.solicitacoes.os.create', compact('produtos','prioridades','codigo_solicitacao_compra','os_solicita_produto_id'));
    }

    public function show()
    {
        $data = [
            'categorias' => Categoria::all()->where('deleted_at', '=', null),
            'prioridades' => DB::table('prioridades')->where('deleted_at', '=', null)->get(),
            'status' => DB::table('status')->where('deleted_at', '=', null)->get(),
            'estoque' => DB::table('produtos')
                ->select('codprod','produtos.id','quantidade_total','produtos.nome as produto','qt_minima',
                    'qt_reposicao','estoque_localizacao.nome as nome_localizacao','localizacao')
                ->where('produtos.deleted_at', '=', null)
                ->leftjoin('estoque','estoque.produto_id','=','produtos.id')
                ->leftjoin('estoque_localizacao','estoque.estoque_local_id','=','estoque_localizacao.id')
                ->get()
        ];

        $solicitacao_compras = SolicitacaoCompra::all()->where('deleted_at', '=', null);
        return view('suprimentos.solicitacoes.compra.show', compact('data','solicitacao_compras'));
    }

    public function edit($id)
    {
        $data = [
            'categorias' => Categoria::all()->where('deleted_at', '=', null),
            'prioridades' => DB::table('prioridades')->where('deleted_at', '=', null)->get(),
            'status' => DB::table('status')->where('deleted_at', '=', null)->get(),
        ];

        $solicitacao_compra = SolicitacaoCompra::all()->where('id', '=', $id)->first();

        $solicitacao_itens = DB::table('solicitacao_compra_produtos')
            ->join('produtos','solicitacao_compra_produtos.produto_id','=','produtos.id')
            ->where('solicitacao_compra_produtos.solicitacao_compra_id', '=', $id)
            ->get();

        return view('suprimentos.solicitacoes.compra.edit', compact('data','solicitacao_compra','solicitacao_itens'));
    }

    public function store(Request $request)
    {
        $sol_compra = SolicitacaoCompra::create([
            'codigo_solicitacao_compra' => $request->get('codigo_solicitacao_compra'),
            'solicitacao' => $request->get('solicitacao'),
            'responsavel_id' => $request->get('responsavel_id'),
            'data_solicitacao' => date('Y-m-d'),
            'status_id' => 2, // Aberta
            'prioridade_id' => $request->get('prioridade_id'),
        ]);

        if(!empty($request->get('os_solicita_produto_id')) && is_numeric($request->get('os_solicita_produto_id'))){
            DB::table('os_solicita_produto')
                ->where('id','=',$request->get('os_solicita_produto_id'))
                ->update(['solicitacao_compra_id' => $sol_compra->id,'updated_at' => date('Y-m-d')]);
        }

        if(!empty($request->get('txt1'))){
            foreach($request->get('txt1') as $key => $item){
                SolicitacaoCompraProduto::create([
                    'solicitacao_compra_id' => $sol_compra->id,
                    'produto_id' => $item,
                    'quantidade' => $request->get('txt2')[$key],
                ]);
            }
        }

        return redirect()->route('almoxarifado.solicitacao.compras.show')
            ->with(['message' => 'A Solicitação de Compra foi registrada no Sistema.',
            'status' => 'Sucesso',
            'type' => 'success']);
    }
}
