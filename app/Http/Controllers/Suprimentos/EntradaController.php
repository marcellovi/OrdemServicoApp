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
    { //dd($request->all());
        $entrada = Entrada::create([
            'num_nf' => $request->get('num_nf'),
            'imposto' => $request->get('imposto'),
            'frete' => $request->get('frete'),
            'total' => $request->get('total'),
            'data_entrada' => date('Y-m-d'),
            'responsavel_id' => $request->get('responsavel_id'),
        ]);

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

        DB::table('solicitacao_compra')
            ->where('id', '=', $request->get('solicitacao_id'))
            ->update(['status_id' => 5]); // Closing the Sale ( Compra )

        return redirect()->route('almoxarifado.solicitacao.compras.show')
            ->with(['message' => 'A Solicitação de Compra foi registrada no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }
}
