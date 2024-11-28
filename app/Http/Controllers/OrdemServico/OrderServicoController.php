<?php

namespace App\Http\Controllers\OrdemServico;

use App\Http\Controllers\Controller;
use App\Models\Ativo;
use App\Models\OrderServico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderServicoController extends Controller
{
    public function index()
    {
        $nr_os = date('Ymdhms');
        $order_servicos = [
            'prioridades' => DB::table('prioridades')->where('deleted_at', '=', null)->get(),
            'natureza_servicos' => DB::table('natureza_servicos')->where('deleted_at', '=', null)->get(),
            'tipo_manutencao' => DB::table('tipo_manutencao')->where('deleted_at', '=', null)->get(),
            'equipes' => DB::table('equipes')->where('deleted_at', '=', null)->get(),
            'ativos' => Ativo::all()->where('deleted_at', '=', null),
            'status' => DB::table('status')->where('deleted_at', '=', null)->where('tipo_status','os')->get(),
            'numero_os' => $nr_os
        ];

        $list_os = OrderServico::select('order_servicos.id as os_id','numero_os','ativos.tags','prioridade_id',
        'prioridades.nome as prioridade','data_abertura','status.nome as status')
            //->join('equipes', 'equipes.id', '=', 'equipe_responsavel_id')
            ->join('prioridades', 'prioridades.id', '=', 'prioridade_id')
            ->join('ativos', 'ativos.id', '=', 'ativo_id')
            ->join('status', 'status.id', '=', 'order_servicos.status_id')
            ->where('order_servicos.deleted_at', '=', null)
            ->orderby('order_servicos.prioridade_id','asc')
            ->orderby('order_servicos.created_at','desc')->get();

        return view('ordemservico.index', compact('order_servicos','list_os'));
    }
    public function store(Request $request){

//        $request->validate([
//            'categoria' => 'required',
//        ]);

        OrderServico::create([
            'numero_os' => $request->get('numero_os'),
            //'tags' => $ativo_id,
            'ativo_id' => $request->get('tags'),
            'prioridade_id' => $request->get('prioridade'),
            'tipo_manutencao_id' => $request->get('tipo_manutencao'),
            'natureza_servico_id' => $request->get('natureza_servico'),
            //'equipe_responsavel_id' => $request->get('eq_responsavel'),
            //'responsavel_id' => $request->get('responsavel'),
            //'executor_id' => $request->get('executor'),
            'data_abertura' => date("Y/m/d"),
            'data_programada' => (!empty($request->get('dtprogramada'))) ? date_format(date_create($request->get('dtprogramada')),"Y/m/d") : null,
        ]);

        return redirect()->route('gestao')
            ->with(['message' => 'Order de Serviço '.$request->get('numero_os').' foi Cadastrado no Sistema.',
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
        $order_servicos = [
            'prioridades' => DB::table('prioridades')->where('deleted_at', '=', null)->get(),
            'natureza_servicos' => DB::table('natureza_servicos')->where('deleted_at', '=', null)->get(),
            'tipo_manutencao' => DB::table('tipo_manutencao')->where('deleted_at', '=', null)->get(),
            'equipes' => DB::table('equipes')->where('deleted_at', '=', null)->get(),
            'ativos' => Ativo::all()->where('deleted_at', '=', null),
            'status_os' => DB::table('status')->where('deleted_at', '=', null)->where('tipo_status','os')->get(),
            'funcionarios' => User::all()->select('matricula','name','email','id'),
        ];

        $os = OrderServico::select('order_servicos.id as os_id','numero_os','ativos.tags','prioridade_id',
            'tipo_manutencao_id','natureza_servico_id','equipe_responsavel_id','responsavel_id','status_id',
            'prioridades.nome as prioridade','data_abertura','data_programada','descritivo','descritivo_executado')
            //->join('equipes', 'equipes.id', '=', 'equipe_responsavel_id')
            ->join('prioridades', 'prioridades.id', '=', 'prioridade_id')
            ->join('ativos', 'ativos.id', '=', 'ativo_id')
            ->where('order_servicos.id',$id)
            ->where('order_servicos.deleted_at', '=', null)
            ->orderby('order_servicos.prioridade_id','asc')
            ->orderby('order_servicos.created_at','desc')->first();// dd($os->numero_os);

        return view('ordemservico.edit',compact('order_servicos','os'));
    }
    public function update(Request $request, $id)
    {
//        $request->validate([
//            'title' => 'required|max:255',
//            'body' => 'required',
//        ]);

        $os = OrderServico::find($id);//dd(date_format(date_create($request->get('dtprogramada')),"Y/m/d"));
        $os->update([
            'data_programada' => date_format(date_create($request->get('dtprogramada')),"Y/m/d"), //$request->get('dtprogramada'),
            'prioridade_id' => $request->get('prioridade'),
            'tipo_manutencao_id' => $request->get('tipo_manutencao'),
            'natureza_servico_id' => $request->get('natureza_servico'),
            'equipe_responsavel_id' => $request->get('eq_responsavel'),
            'responsavel_id' => $request->get('responsavel'),
            'executor_id' => $request->get('executor'),
            'status_id' => $request->get('os_status'),
            'descritivo' => $request->get('editor'),
            'descritivo_executado' => $request->get('desc_executado'),
        ]);
        return redirect()->route('gestao')
            ->with(['message' => 'OS N. '.$request->get('numero_os').' foi Atualizado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }
    public function destroy($id){

        $os = OrderServico::find($id);
        $n_os = $os->numero_os;
        $os->delete();

        return redirect()->route('gestao')
            ->with(['message' => 'OS N. '.$n_os .' foi Excluido do Sistema.',
                'status' => 'Deletado',
                'type' => 'info']);
    }


    /*********************** CHAMADOS **********************/

    public function chamado()
    {
        $nr_os = date('Ymdhms');
        $order_servicos = [
            'prioridades' => DB::table('prioridades')->where('deleted_at', '=', null)->get(),
            'natureza_servicos' => DB::table('natureza_servicos')->where('deleted_at', '=', null)->get(),
            'tipo_manutencao' => DB::table('tipo_manutencao')->where('deleted_at', '=', null)->get(),
            'equipes' => DB::table('equipes')->where('deleted_at', '=', null)->get(),
            'ativos' => Ativo::all()->where('deleted_at', '=', null),
            'status' => DB::table('status')->where('deleted_at', '=', null)->where('tipo_status','os')->get(),
            'numero_os' => $nr_os
        ];

        $list_os = OrderServico::select('order_servicos.id as os_id','numero_os','ativos.tags','prioridade_id',
            'prioridades.nome as prioridade','data_abertura','status.nome as status')
            //->join('equipes', 'equipes.id', '=', 'equipe_responsavel_id')
            ->join('prioridades', 'prioridades.id', '=', 'prioridade_id')
            ->join('ativos', 'ativos.id', '=', 'ativo_id')
            ->join('status', 'status.id', '=', 'order_servicos.status_id')
            ->where('order_servicos.deleted_at', '=', null)
            ->where('order_servicos.status_id','=',1)
            ->orderby('order_servicos.prioridade_id','asc')
            ->orderby('order_servicos.created_at','desc')->get();

        return view('ordemservico.chamados.index', compact('order_servicos','list_os'));
    }

    public function chamadoStore(Request $request){

//        $request->validate([
//            'categoria' => 'required',
//        ]);

        OrderServico::create([
            'numero_os' => $request->get('numero_os'),
            //'tags' => $ativo_id,
            'ativo_id' => $request->get('tags'),
            'prioridade_id' => $request->get('prioridade'),
            'tipo_manutencao_id' => $request->get('tipo_manutencao'),
            'natureza_servico_id' => $request->get('natureza_servico'),
            //'equipe_responsavel_id' => $request->get('eq_responsavel'),
            //'responsavel_id' => $request->get('responsavel'),
            //'executor_id' => $request->get('executor'),
            'data_abertura' => date("Y/m/d"),
            'data_programada' => (!empty($request->get('dtprogramada'))) ? date_format(date_create($request->get('dtprogramada')),"Y/m/d") : null,
        ]);

        return redirect()->route('chamado.index')
            ->with(['message' => 'Chamado '.$request->get('numero_os').' foi Aberto no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }
}
