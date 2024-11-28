@extends('admin.main_master')

@section('style')
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datepicker/datepicker.material.css') }}">
@endsection

@section('scripts')
{{--    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

    <!-- Date Picker-->
    <script src="{{ asset('assets/js/datepicker/datepicker.js') }}"></script>
    <script>
       // var dtabertura = new Datepicker('#dtabertura');
        var dtprogramada = new Datepicker('#dtprogramada');
    </script>
@endsection

<!-- row -->
@section('main')

    <!-- Cadastro de OS -->
    <div class="col-lg-5 mt-4">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Abrir Chamados - <span class="text-success">{{ $order_servicos['numero_os'] }}</span></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('chamado.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="numero_os" name="numero_os" placeholder=""
                               class="form-control" value="{{ $order_servicos['numero_os'] }}">
{{--                        <div class="mb-2 col-md-2">--}}
{{--                            <p class="font-weight-400 mb-2">N. Chamado</p>                            --}}
{{--                        </div>--}}
                        <div class="mb-2 col-md-5">
                            <p class="font-weight-400 mb-2">Tag.</p>
                            <select id="tags" name="tags" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($order_servicos['ativos'] as $ativo)
                                    <option value="{{ $ativo->id }}">{{ $ativo->tags }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-5">
                            <p class="font-weight-400 mb-2">Prioridade</p>
                            <select id="prioridade" name="prioridade" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($order_servicos['prioridades'] as $prioridade)
                                    <option value="{{ $prioridade->id }}">{{ $prioridade->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-5">
                            <p class="font-weight-400 mb-2">Manutenção</p>
                            <select id="tipo_manutencao" name="tipo_manutencao" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($order_servicos['tipo_manutencao'] as $manutencao)
                                    <option value="{{ $manutencao->id }}">{{ $manutencao->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-5">
                            <p class="font-weight-400 mb-2">Naturea do Serviço</p>
                            <select id="natureza_servico" name="natureza_servico" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($order_servicos['natureza_servicos'] as $natureza_servico)
                                    <option value="{{ $natureza_servico->id }}">{{ $natureza_servico->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn float-right btn-primary ml-3">ABRIR</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Cadastro Profissionais -->


    <!-- OS Programadas -->
    <div class="col-md-7 mt-4">
        <div class="card o-hidden mb-4">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Chamados Em Aberto</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table id="user_table" class="table dataTable-collapse text-center">
                        <thead>
                        <tr>
                            <th scope="col">AÇÕES</th>
                            <th scope="col">CHAMADO</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">TAGS</th>
                            <th scope="col">PRIORIDADE</th>
                            <th scope="col">DT. CRIAÇÃO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_os as $os)
                            <tr>
                                <td>
                                    <a href="{{ route('gestao.edit',$os->os_id) }}" class="text-success mr-2">
                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>
                                    <a href="{{ route('gestao.destroy',$os->os_id) }}" class="text-danger mr-2">
                                        <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                    </a>
                                </td>
                                <td><b>{{ $os->numero_os }}</b></td>
                                <td>
                                    @if(ucfirst($os->status)  == 'Em Analise')
                                        <span class="badge badge-waiting">{{ $os->status }}</span>
                                    @elseif(ucfirst($os->status)  == 'Aberta')
                                        <span class="badge badge-success">{{ $os->status }}</span>
                                    @else
                                        <span class="badge badge-info">{{ $os->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $os->tags }}</td>
                                <td>
                                        @if($os->prioridade == 'Alta')
                                            <span class="badge badge-success">ALTA</span>
                                        @elseif($os->prioridade == 'Media')
                                            <span class="badge badge-danger">MEDIA</span>
                                        @else
                                            <span class="badge badge-warning">BAIXA</span>
                                        @endif
                                </td>
                                <td>
                                    {{ date_format($ativo->created_at,"d/m/Y") }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end of col-->

@endsection
