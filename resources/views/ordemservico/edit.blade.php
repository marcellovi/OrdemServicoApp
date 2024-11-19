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
    {{--    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}



    <!-- Quill Editor -->

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        const quill2 = new Quill('#desc_executado', {
            theme: 'snow'
        });
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

        <!-- Editor de OS -->
        <div class="col-lg-12 col-md-4 mb-4">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="w-50 float-left card-title m-0">Editar OS</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('gestao.update',$os->os_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="mb-2 col-md-2">
                            <p class="font-weight-400 mb-2">Nr.OS</p>
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
                                @foreach($order_servicos['prioridades'] as $prioridade)
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
                            <p class="font-weight-400 mb-2">Tp. Manutenção</p>
                            <select id="tipo_manutencao" name="tipo_manutencao" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($order_servicos['tipo_manutencao'] as $manutencao)
                                    <option value="{{ $manutencao->id }}" {{ ($manutencao->id == $os->tipo_manutencao_id) ? "selected" : ""}}>{{ $manutencao->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2 col-md-4">
                            <p class="font-weight-400 mb-2">Naturea do Serviço</p>
                            <select id="natureza_servico" name="natureza_servico" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($order_servicos['natureza_servicos'] as $natureza_servico)
                                    <option value="{{ $natureza_servico->id }}" {{ ($natureza_servico->id == $os->natureza_servico_id) ? "selected" : ""}}>{{ $natureza_servico->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-2">
                            <p class="font-weight-400 mb-2">Status da OS</p>
                            <select id="os_status" name="os_status" class="form-control" required="true">
                                <option value="1" selected>Em Analise</option>
                                <option value="3">Aberta</option>
                                <option value="2">Pausada</option>
                                <option value="2">Em Execução</option>
                                <option value="2">Fechada</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <p class="font-weight-400 mb-2">Eq. Responsável</p>
                            <select id="eq_responsavel" name="eq_responsavel" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                @foreach($order_servicos['equipes'] as $equipe)
                                    <option value="{{ $equipe->id }}" {{ ($equipe->id == $os->equipe_responsavel_id) ? "selected" : ""}}>{{ $equipe->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <p class="font-weight-400 mb-2">Responsavel</p>
                            <select id="responsavel" name="responsavel" class="form-control" required="true">
                                <option value="" selected>---Selecione---</option>
                                <option value="1">Marcus V.</option>
                                <option value="2">Carlos A.</option>
                                <option value="3">Julia B.</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-3">
                            <p class="font-weight-400 mb-2">Executor</p>
                            <select id="executor" name="executor" class="form-control" required="true">
                                <option value="" selected>---Nenhum---</option>
                                <option value="1">Jose R.</option>
                                <option value="2">Maria D.</option>
                            </select>
                        </div>
                    </div>

                        <p class="font-weight-400 mb-2">Descritivo</p>
                        <div id="editor" name="editor">{{ $os->descritivo }}</div>
                        <br>

                        <p class="font-weight-400 mb-2">Descritivo Executado</p>
{{--                        <textarea id="desc_executado" name="desc_executado">{{ $os->descritivo_executado }}</textarea>--}}
                        <div id="desc_executado" name="desc_executado">{{ $os->descritivo_executado }}</div>

                        <br>
                        <a href="{{ route('gestao') }}" class="btn float-right btn-primary ml-3">Voltar</a>
                        <button type="submit" class="btn float-right btn-primary ml-3">EDITAR</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Editar OS -->

@endsection
<!-- end of row-->



