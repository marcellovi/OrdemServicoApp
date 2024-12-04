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

    <div class="mb-4 col-md-12 mt-3" align="right">
        {{--        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContentSolicitarCompra"--}}
        {{--                data-whatever="@mdo">Solicitar Compra--}}
        {{--        </button>--}}
        <button type="button" class="btn btn-info btn-icon m-1" data-toggle="modal" data-target="#verifyModalContentSolicitarCompra" data-whatever="@mdo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16">
                <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512"/>
            </svg>
            <span class="ul-btn__text">&nbsp; Abrir Chamado</span>
        </button>
    </div>

    <!-- OS Programadas -->
    <div class="col-md-12 mt-1">
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
                            <th scope="col">DT. LIMITE</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_os as $os)
                            <tr>
                                <td>
                                    <a href="{{ route('chamado.edit',$os->os_id) }}" class="text-success mr-2">
                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>
                                    <a href="{{ route('chamado.destroy',$os->os_id) }}" class="text-danger mr-2">
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
                                        @if($os->prioridade == 'Emergencial')
                                            <span class="badge badge-danger">EMERGENCIAL</span>
                                        @elseif($os->prioridade == 'Alta')
                                            <span class="badge badge-waiting">ALTA</span>
                                        @elseif($os->prioridade == 'Media')
                                            <span class="badge badge-warning">MEDIA</span>
                                        @else
                                            <span class="badge badge-info">BAIXA</span>
                                        @endif
                                </td>
                                <td>
                                    {{ date_format($os->created_at,"d/m/Y") }}
                                </td>
                                <td>
                                    {{ $os->tempo_limite }}
{{--                                    {{  date('d/m/Y', strtotime(date_create($ativo->created_at), ' + '.$os->tempo_limite)) }}--}}
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

    <!-- modal cadastro chamado -->
    <div class="modal fade" id="verifyModalContentSolicitarCompra" tabindex="-1" role="dialog"
         aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">CHAMADO N. <span class="text-success">{{ $order_servicos['numero_os'] }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- Cadastro de OS -->
                    <form action="{{ route('chamado.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="numero_os" name="numero_os" placeholder=""
                                   class="form-control" value="{{ $order_servicos['numero_os'] }}">
                            {{--                        <div class="mb-2 col-md-2">--}}
                            {{--                            <p class="font-weight-400 mb-2">N. Chamado</p>                            --}}
                            {{--                        </div>--}}
                            <div class="mb-2 col-md-12">
                                <p class="font-weight-400 mb-2">Tag.</p>
                                <select id="tags" name="tags" class="form-control" required="true">
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($order_servicos['ativos'] as $ativo)
                                        <option value="{{ $ativo->id }}">{{ $ativo->tags }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-md-6">
                                <p class="font-weight-400 mb-2">Prioridade</p>
                                <select id="prioridade" name="prioridade" class="form-control" required="true">
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($order_servicos['prioridades'] as $prioridade)
                                        <option value="{{ $prioridade->id }}">{{ $prioridade->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--                        <div class="mb-2 col-md-5">--}}
                            {{--                            <p class="font-weight-400 mb-2">Manutenção</p>--}}
                            {{--                            <select id="tipo_manutencao" name="tipo_manutencao" class="form-control" required="true">--}}
                            {{--                                <option value="" selected>---Selecione---</option>--}}
                            {{--                                @foreach($order_servicos['tipo_manutencao'] as $manutencao)--}}
                            {{--                                    <option value="{{ $manutencao->id }}">{{ $manutencao->nome }}</option>--}}
                            {{--                                @endforeach--}}
                            {{--                            </select>--}}
                            {{--                        </div>--}}
                            <div class="mb-2 col-md-6">
                                <p class="font-weight-400 mb-2">Naturea do Serviço</p>
                                <select id="natureza_servico" name="natureza_servico" class="form-control"
                                        required="true">
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($order_servicos['natureza_servicos'] as $natureza_servico)
                                        <option
                                            value="{{ $natureza_servico->id }}">{{ $natureza_servico->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn float-right btn-primary ml-3">Abir Chamado</button>
                        </div>
                    </form>

                <!-- End Cadastro Profissionais -->

            </div>
        </div>
    </div>

@endsection
