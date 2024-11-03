<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Ativo;
use App\Models\OrderServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderServicoController extends Controller
{
    public function index()
    {
        $order_servicos = [
            'prioridades' => DB::table('prioridades')->where('deleted_at', '=', null)->get(),
            'natureza_servicos' => DB::table('natureza_servicos')->where('deleted_at', '=', null)->get(),
            'tipo_manutencao' => DB::table('tipo_manutencao')->where('deleted_at', '=', null)->get(),
            'equipes' => DB::table('equipes')->where('deleted_at', '=', null)->get(),
            'ativos' => Ativo::all()->where('deleted_at', '=', null),
            'numero_os' => uniqid()
        ]; //dd($order_servicos );

        $list_os = OrderServico::select('numero_os','ativos.tags','equipes.nome',
        'prioridades.nome as prioridade')
            ->join('equipes', 'equipes.id', '=', 'equipe_responsavel_id')
            ->join('prioridades', 'prioridades.id', '=', 'prioridade_id')
            ->join('ativos', 'ativos.id', '=', 'ativo_id')
            ->where('order_servicos.deleted_at', '=', null)->orderby('order_servicos.created_at','desc')->get();

        return view('management.index', compact('order_servicos','list_os'));
    }


    public function store(Request $request){

//        $request->validate([
//            'categoria' => 'required',
//        ]);

        $ativo_id = $request->get('tags');

        OrderServico::create([
            'numero_os' => $request->get('numero_os'),
            'tags' => $ativo_id,
            'ativo_id' => $ativo_id,
            'prioridade_id' => $request->get('prioridade'),
            'tipo_manutencao_id' => $request->get('tipo_manutencao'),
            'natureza_servico_id' => $request->get('natureza_servico'),
            'equipe_responsavel_id' => $request->get('eq_responsavel'),
            'responsavel_id' => $request->get('responsavel'),
            'executor_id' => $request->get('executor'),
            'data_abertura' => date("Y/m/d"),
            'data_programada' => date("Y/m/d")
        ]);

        return redirect()->route('gestao')
            ->with(['message' => 'Order de Serviço '.$request->get('numero_os').' foi Cadastrado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }
}
