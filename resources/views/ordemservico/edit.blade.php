@extends('admin.main_master')

@section('style')
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datepicker/datepicker.material.css') }}">

    <!-- Quill Rich Text Editor -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet"/>

    <!-- Test Widget
    <link rel="stylesheet" href="https://maposdemo.sysgo.com.br/assets/css/matrix-style.css">-->

@endsection

@section('scripts')
{{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}


    <!-- Quill Editor -->

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        const quill2 = new Quill('#desc_executado', {
            theme: 'snow'
        });

        // setting to hidden input the quill innerHTML
        $("#edtfrm").on("submit",function() {
            $("#diagnostico").val(quill.root.innerHTML);
            $("#solucao").val(quill2.root.innerHTML);
        })

        // set database values to quill
        quill.root.innerHTML = '{!! $os->diagnostico !!}';
        quill2.root.innerHTML = '{!! $os->solucao !!}';


    </script>

    <!-- Date Picker-->
    <script src="{{ asset('assets/js/datepicker/datepicker.js') }}"></script>
    <script>
        var dtabertura = new Datepicker('#dtabertura');
        var dtprogramada = new Datepicker('#dtprogramada');
    </script>
@endsection

<!-- row -->
@section('main')

    <div class="mb-4 col-md-12 mt-3" align="right">
{{--        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContentSolicitarCompra"--}}
{{--                data-whatever="@mdo">Solicitar Compra--}}
{{--        </button>--}}
        <a href="#" class="btn btn-info btn-icon m-1" data-toggle="modal" data-target="#verifyModalContentSolicitarCompra" data-whatever="@mdo">
            <span class="ul-btn__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone-vibrate" viewBox="0 0 16 16">
                  <path d="M10 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM6 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"/>
                  <path d="M8 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2M1.599 4.058a.5.5 0 0 1 .208.676A7 7 0 0 0 1 8c0 1.18.292 2.292.807 3.266a.5.5 0 0 1-.884.468A8 8 0 0 1 0 8c0-1.347.334-2.619.923-3.734a.5.5 0 0 1 .676-.208m12.802 0a.5.5 0 0 1 .676.208A8 8 0 0 1 16 8a8 8 0 0 1-.923 3.734.5.5 0 0 1-.884-.468A7 7 0 0 0 15 8c0-1.18-.292-2.292-.807-3.266a.5.5 0 0 1 .208-.676M3.057 5.534a.5.5 0 0 1 .284.648A5 5 0 0 0 3 8c0 .642.12 1.255.34 1.818a.5.5 0 1 1-.93.364A6 6 0 0 1 2 8c0-.769.145-1.505.41-2.182a.5.5 0 0 1 .647-.284m9.886 0a.5.5 0 0 1 .648.284C13.855 6.495 14 7.231 14 8s-.145 1.505-.41 2.182a.5.5 0 0 1-.93-.364C12.88 9.255 13 8.642 13 8s-.12-1.255-.34-1.818a.5.5 0 0 1 .283-.648"/>
                </svg>
            </span>
            <span class="ul-btn__text">&nbsp; Solicitar Compra</span>
        </a>
    </div>

        <!-- Editor de OS -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="w-50 float-left card-title m-0">Editar OS</h3>
                </div>
                <div class="card-body">
                    <form id="edtfrm" action="{{ route('gestao.update',$os->os_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="mb-2 col-md-2">
                            <p class="font-weight-400 mb-2">OS</p>
                            <input type="text" id="numero_os" name="numero_os" placeholder="" class="form-control" value="{{ $os->numero_os }}" readonly>
                        </div>
                        <div class="mb-2 col-md-5">
                            <p class="font-weight-400 mb-2">Tag.</p>
                            <input type="text" id="tag" name="tag" placeholder="" class="form-control" value="{{ $os->tags }}" readonly>

                        </div>
                        <div class="mb-2 col-md-5">
                            <p class="font-weight-400 mb-2">Prioridade</p>
                            <select id="prioridade" name="prioridade" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($ordem_servicos['prioridades'] as $prioridade)
                                    <option value="{{ $prioridade->id }}" {{ ($prioridade->id == $os->prioridade_id) ? "selected" : ""}}>{{ $prioridade->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-2">
                            <p class="font-weight-400 mb-2">Dt. Programada</p>
                            <input id="dtprogramada" name="dtprogramada" type="text"
                                   placeholder="__/__/__" class="form-control" required="true" value="{{ date_format(date_create($os->data_programada),'m/d/Y') }}">
                        </div>
                        <div class="mb-2 col-md-4">
                            <p class="font-weight-400 mb-2">Manutenção</p>
                            <select id="tipo_manutencao" name="tipo_manutencao" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($ordem_servicos['tipo_manutencao'] as $manutencao)
                                    <option value="{{ $manutencao->id }}" {{ ($manutencao->id == $os->tipo_manutencao_id) ? "selected" : ""}}>{{ $manutencao->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-4">
                            <p class="font-weight-400 mb-2">Naturea do Serviço</p>
                            <select id="natureza_servico" name="natureza_servico" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($ordem_servicos['natureza_servicos'] as $natureza_servico)
                                    <option value="{{ $natureza_servico->id }}" {{ ($natureza_servico->id == $os->natureza_servico_id) ? "selected" : ""}}>{{ $natureza_servico->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-2">
                            <p class="font-weight-400 mb-2">Status da OS</p>
                            <select id="os_status" name="os_status" class="form-control" required="true">
                                @foreach($ordem_servicos['status_os'] as $status)
                                    <option value="{{ $status->id }}" {{ ($status->id == $os->status_id) ? 'selected' : '' }}>{{ $status->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <p class="font-weight-400 mb-2">Equipe</p>
                            <select id="eq_responsavel" name="eq_responsavel" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($ordem_servicos['equipes'] as $equipe)
                                    <option value="{{ $equipe->id }}" {{ ($equipe->id == $os->equipe_responsavel_id) ? "selected" : ""}}>{{ $equipe->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <p class="font-weight-400 mb-2">Responsável</p>
                            <select id="responsavel" name="responsavel" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($ordem_servicos['funcionarios'] as $funcionario)
                                    <option value="{{ $funcionario['id']}}" {{ ($funcionario['id'] == $os->responsavel_id) ? "selected" : ""}}>{{ $funcionario['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <p class="font-weight-400 mb-2">Mantenedor</p>
                            <select id="mantenedor" name="mantenedor" class="form-control" required="true">
                                <option value="" selected>---Nenhum---</option>
                                @foreach($ordem_servicos['funcionarios'] as $funcionario)
                                    <option value="{{ $funcionario['id']}}" {{ ($funcionario['id'] == $os->mantenedor_id) ? "selected" : ""}}>{{ $funcionario['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                                <p class="font-weight-400 mb-2">Auxiliar</p>
                                <select id="auxiliar" name="auxiliar" class="form-control" required="true">
                                    <option value="" selected>---Nenhum---</option>
                                    @foreach($ordem_servicos['funcionarios'] as $funcionario)
                                        <option value="{{ $funcionario['id']}}" {{ ($funcionario['id'] == $os->auxiliar_id) ? "selected" : ""}}>{{ $funcionario['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                        <p class="font-weight-400 mb-2">Diagnostico</p>
                        <div id="editor" name="editor"></div>
                        <textarea name="diagnostico" style="display:none" id="diagnostico"></textarea>
                        <br>
                        <p class="font-weight-400 mb-2">Solução</p>
                        <div id="desc_executado" name="desc_executado"></div>
                        <textarea name="solucao" style="display:none" id="solucao"></textarea>
                        <br>
                        <a href="{{ route('gestao') }}" class="btn float-right btn-primary ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"></path>
                            </svg>
                            Voltar</a>
                        <button type="submit" class="btn float-right btn-primary ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"></path>
                            </svg>&nbsp; Editar</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Editar OS -->
@endsection
<!-- end of row-->



