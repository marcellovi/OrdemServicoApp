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
        <div class="col-lg-12">
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
                        <div id="editor" name="editor">{{ $os->descritivo }}</div>
                        <br>

                        <p class="font-weight-400 mb-2">Solução</p>
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



