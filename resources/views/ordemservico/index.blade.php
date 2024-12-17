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

<script defer src="https://unpkg.com/alpinejs@latest/dist/cdn.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
@endsection

<!-- row -->
@section('main')
    <div class="mb-4 col-md-12 mt-3" align="right">
        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentOS"
                data-whatever="@mdo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <span class="ul-btn__text">&nbsp; Cadastrar OS</span>
        </button>
    </div>

    <!-- OS Programadas -->
    <div class="col-md-12 col-md-4 mb-4">
        <div class="card o-hidden mb-4">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">OS Programadas</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table id="user_table" class="table dataTable-collapse text-center">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 20%">N.OS</th>
                            <th scope="col" style="width: 10%">STATUS</th>
                            <th scope="col" style="width: 20%">TAGS</th>
                            <th scope="col" style="width: 15%">PRIORIDADE</th>
                            <th scope="col" style="width: 10%">DT. CRIAÇÃO</th>
                            <th scope="col" style="width: 10%">DT. LIMITE</th>
                            <th scope="col" style="width: 15%">AÇÕES</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_os as $os)
                            <tr>
                                <td style="width: 20%"><b>{{ $os->numero_os }}</b></td>
                                <td style="width: 10%">
                                    @if(ucfirst($os->status)  == 'Em Analise')
                                        <span class="badge badge-waiting">{{ $os->status }}</span>
                                    @elseif(ucfirst($os->status)  == 'Aberta')
                                        <span class="badge badge-success">{{ $os->status }}</span>
                                    @else
                                        <span class="badge badge-info">{{ $os->status }}</span>
                                    @endif
                                </td>
                                <td style="width: 20%">{{ $os->tags }}</td>
                                <td style="width: 15%">
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
                                <td style="width: 10%">
                                    {{ date_format($os->created_at,"d/m/Y") }}
                                </td>
                                <td style="width: 10%">
                                    {{ $os->tempo_limite }}
                                </td>
                                <td style="width: 15%">
                                    <a href="{{ route('gestao.edit',$os->os_id) }}" title="Editar OS"
                                       class="btn btn-outline-success m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>
                                    <a href="{{  route('gestao.destroy',$os->os_id) }}" title="Deletar OS"
                                       class="btn btn-outline-danger m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </a>
                                    @isset($os->solicita_produto_id)
                                    <a href="{{  route('almoxarifado.solicitacao.edit',$os->solicita_produto_id) }}" title="Visualizar Solicitação da OS"
                                       class="btn btn-outline-info m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                                        </svg>
                                    </a>
                                    @endisset


                                    {{--                                    <a href="{{  route('gestao.edit',$os->os_id) }}"--}}
                                    {{--                                       class="btn btn-outline-success m-1">--}}
                                    {{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"--}}
                                    {{--                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">--}}
                                    {{--                                            <path--}}
                                    {{--                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>--}}
                                    {{--                                            <path fill-rule="evenodd"--}}
                                    {{--                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>--}}
                                    {{--                                        </svg>--}}
                                    {{--                                    </a>--}}
                                    {{--                                    <a href="{{ route('gestao.destroy',$os->os_id) }}" class="btn btn-outline-danger btn-icon m-1">--}}
                                    {{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"--}}
                                    {{--                                             fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">--}}
                                    {{--                                            <path--}}
                                    {{--                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>--}}
                                    {{--                                            <path--}}
                                    {{--                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>--}}
                                    {{--                                        </svg>--}}
                                    {{--                                    </a>--}}
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

    <!-- modal cadastro usuario -->
    <div class="modal fade" id="verifyModalContentOS" tabindex="-1" role="dialog"
         aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">Cadastrar OS N. <span class="text-success">{{ $ordem_servicos['numero_os'] }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>


                <form action="gestao/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <!-- Cadastro de OS -->

{{--                            <div class="mb-2 col-md-2">--}}
{{--                                <p class="font-weight-400 mb-2">OS</p>--}}
                                <input type="hidden" id="numero_os"
                                       name="numero_os" placeholder=""
                                       class="form-control"
                                       value="{{ $ordem_servicos['numero_os'] }}">
{{--                            </div>--}}
                            <div class="mb-2 col-md-12">
                                <p class="font-weight-400 mb-2">Tag.</p>
                                <select id="tags" name="tags" class="form-control" required="true">
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($ordem_servicos['ativos'] as $ativo)
                                        <option value="{{ $ativo->id }}">{{ $ativo->tags }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-md-6">
                                <p class="font-weight-400 mb-2">Prioridade</p>
                                <select id="prioridade" name="prioridade" class="form-control" required="true">
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($ordem_servicos['prioridades'] as $prioridade)
                                        <option value="{{ $prioridade->id }}">{{ $prioridade->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

{{--                            <div class="mb-3  col-md-6">--}}
{{--                                <p class="font-weight-400 mb-2">Dt. Abertura</p><input id="dtabertura"--}}
{{--                                                                                       name="dtabertura"--}}
{{--                                                                                       type="text"--}}
{{--                                                                                       placeholder="__/__/__"--}}
{{--                                                                                       class="form-control"--}}
{{--                                                                                       required="true">--}}
{{--                            </div>--}}
                            <div class="mb-2 col-md-6">
                                <p class="font-weight-400 mb-2">Dt. Programada</p>
{{--                                <input id="dtprogramada" name="dtprogramada" type="text" placeholder="__/__/__"--}}
{{--                                       class="form-control">--}}

                                <div
                                    x-data
                                    x-init="
                                        flatpickr($refs.dateInput, {
                                          altInput: true,
                                          altFormat: 'd-m-Y',
                                          dateFormat: 'Y-m-d'
                                        })
                                      "
                                >
                                    <input x-ref="dateInput" type="text"  name="dtprogramada" placeholder="DD-MM-AAAA" class="w-full"/>
                                </div>
                            </div>
                            <div class="mb-2 col-md-6">
                                <p class="font-weight-400 mb-2">Manutenção</p>
                                <select id="tipo_manutencao" name="tipo_manutencao" class="form-control"
                                        required="true">
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($ordem_servicos['tipo_manutencao'] as $manutencao)
                                        <option value="{{ $manutencao->id }}">{{ $manutencao->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-md-6">
                                <p class="font-weight-400 mb-2">Naturea do Serviço</p>
                                <select id="natureza_servico" name="natureza_servico" class="form-control"
                                        required="true">
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($ordem_servicos['natureza_servicos'] as $natureza_servico)
                                        <option
                                            value="{{ $natureza_servico->id }}">{{ $natureza_servico->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{--                                            <br>--}}
                            {{--                                            <button type="submit" class="btn float-right btn-primary ml-3">CADASTRAR</button>--}}

                            <!-- End Cadastro Profissionais -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
