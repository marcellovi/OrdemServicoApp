<?php

namespace App\Http\Controllers\Suprimentos;

use App\Http\Controllers\Controller;
use App\Models\Entrada;
use App\Models\Estoque;
use App\Models\ItemEntrada;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{

    public function index()
    {
        $produtos = Produto::all()->where('deleted_at', '=', null);
        $prioridades =  DB::table('prioridades')->where('deleted_at', '=', null)->get();
        $codigo_solicitacao_compra = 'SC-'.date('YmdHis');
        return view('suprimentos.solicitacoes.compra.index', compact('produtos','prioridades','codigo_solicitacao_compra'));
    }

    public function edit($solicitacao_id)
    {
        $produtos = Produto::all()->where('deleted_at', '=', null);

        $produtos_solicitados = DB::table('produtos')
            ->select('produtos.nome','solicitacao_compra_id','produto_id','quantidade')
            ->join('solicitacao_compra_produtos','produtos.id','=','solicitacao_compra_produtos.produto_id')
            ->where('solicitacao_compra_id', '=', $solicitacao_id)
            ->get();

        return view('suprimentos.solicitacoes.entrada.edit', compact('produtos','produtos_solicitados'));
    }

    public function store(Request $request)
    {
        // Nao permitir fazer uma solicitacao sem incluir o Produto necessario para compra
        if(empty($request->get('txt1'))) {
            return redirect()->route('almoxarifado.compras.entrada.edit', $request->get('solicitacao_id'))
                ->with(['message' => 'Favor preencher o campo "Entrada de Produtos".',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }

        // Registro a Entrada da Nota fiscal
        $entrada = Entrada::create([
            'num_nf' => $request->get('num_nf'),
            'imposto' => $request->get('imposto'),
            'frete' => $request->get('frete'),
            'total' => $request->get('total'),
            'data_entrada' => date('Y-m-d'),
            'responsavel_id' => $request->get('responsavel_id'),
        ]);

        // Registro dos Produtos da Nota Fiscal, Valor e QTD
        foreach($request->get('txt1') as $key => $item){

            ItemEntrada::create([
                'solicitacao_compra_id' => $request->get('solicitacao_id'),
                'entrada_id' => $entrada->id,
                'produto_id' => $item,
                'quantidade' => $request->get('txt2')[$key],
                'valor' => $request->get('txt3')[$key],
            ]);

            // Atualizando o Estoque
            DB::table('estoque')
                ->where('produto_id', $item)
                ->update(['quantidade_total' => $request->get('txt2')[$key]]);
        }

        // Atualizando status da Solicitacao de Compra
        DB::table('solicitacao_compra')
            ->where('id', '=', $request->get('solicitacao_id'))
            ->update(['status_id' => 13]); // Compra Finalizada

        // Atualizando status da Solicitacao do Produto ( que gerou a compra )
        DB::table('os_solicita_produto')
            ->where('solicitacao_compra_id', '=', $request->get('solicitacao_id'))
            ->update(['status_id' => 13]); //  Compra Finalizada

        $ordem_servico_id = DB::table('os_solicita_produto')
            ->where('solicitacao_compra_id', '=', $request->get('solicitacao_id'))
            ->first()->ordem_servico_id;

        // Atualizando status da Ordem de Servico
        DB::table('ordem_servicos')
            ->where('id', '=', $ordem_servico_id)
            ->update(['status_id' => 13]); //  Compra Finalizada

        return redirect()->route('almoxarifado.solicitacao.compras.show')
            ->with(['message' => 'A Solicitação de Compra foi registrada no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }
}
