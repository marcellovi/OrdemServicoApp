@extends('admin.main_master')

@section('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

<!-- row -->
@section('main')

            <div class="col-lg-6 col-md-4 mb-4">
                <form action="ativos/store" method="POST">
                    @csrf
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Cadastro de Ativos</h3>
                    </div>
            <div class="card-body">
                <h4 class="card-title mb-3"></h4>
                <div class="row" x-data="{ tags: '' }">
                    <div class="mb-3 col-md-12">
                        <p class="font-weight-400 mb-2">Tags</p>
                        <input type="text" id="tags" class="form-control"
                               value="" name="tags" x-model.fill="tags" readonly="true">
                        <!--                FS01-BL03-AND02-SL03-AC01                    <input type="text" id="tags"  class="form-control" data-role="tagsinput"  value="TAG-0001">-->
                    </div>

                    <div class="mb-3 col-md-12">
                        <p class="font-weight-400 mb-2">Buscar Nome/Sigla Ativo *</p>
                        <select id="ativo_modelo" name="ativo_modelo" class="form-control" required="true">
                            <option value="" selected>---Selecione---</option>
                                @foreach($assets['ativos_modelo'] as $at_modelo)
                                    <option
                                        value="{{ $at_modelo->id }}">{{ strtoupper($at_modelo->sigla).'-'.strtoupper($at_modelo->nome) }}</option>
                                @endforeach
                        </select>
                    </div>
{{--                    <div class="mb-3 col">--}}
{{--                        <p class="font-weight-400 mb-2">Categoria *</p>--}}
{{--                        <select id="categoria" name="categoria" class="form-control" required="true">--}}
{{--                            <option value="">---Selecione---</option>--}}
{{--                            @foreach($assets['categorias'] as $categoria)--}}
{{--                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <p class="font-weight-400 mb-2">Modelo</p><input type="text" id="modelo"--}}
{{--                                                                         name="modelo" placeholder="Modelo"--}}
{{--                                                                         class="form-control" value="">--}}
{{--                    </div>--}}
{{--                    <div class="mb-3 col-md-6">--}}
{{--                        <p class="font-weight-400 mb-2">N. Série</p><input type="text" id="serie"--}}
{{--                                                                           name="serie"--}}
{{--                                                                           placeholder="N. Série"--}}
{{--                                                                           class="form-control"--}}
{{--                                                                           value="">--}}
{{--                    </div>--}}
                    <!-- fase-bloco-andar-sala_area -->
                    <div class="mb-3 col-md-3">
                        <p class="font-weight-400 mb-2">Fase *</p>
                        <select class="form-control" id="fase" name="fase" required="true" x-ref="fase"
                                x-on:change="tags = $el.options[$el.selectedIndex].text">
                            <option value="">---Nenhum---</option>
                            @foreach($assets['fases'] as $fase)
                                <option value="{{ $fase->id }}">{{ $fase->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <p class="font-weight-400 mb-2">Loc. Bloco *</p>
                        <select class="form-control" id="bloco" name="bloco" required="true" x-ref="bloco"
                                x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                            <option value="">---Nenhum---</option>
                            @foreach($assets['blocos'] as $bloco)
                                <option value="{{ $bloco->id }}">{{ $bloco->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <p class="font-weight-400 mb-2">Loc. Andar *</p>
                        <select class="form-control" id="andar" name="andar" required="true" x-ref="andar"
                                x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                            <option value="">---Nenhum---</option>
                            @foreach($assets['andares'] as $andar)
                                <option value="{{ $andar->id }}">{{ $andar->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <p class="font-weight-400 mb-2">Loc. Sala/Área *</p>
                        <select class="form-control" id="sala_area" name="sala_area" required="true"
                                x-ref="sala_area"
                                x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $refs.andar.options[$refs.andar.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                            <option value="">---Nenhum---</option>
                            @foreach($assets['sala_areas'] as $sala_area)
                                <option value="{{ $sala_area->id }}">{{ $sala_area->nome }}</option>
                            @endforeach
                        </select>
                    </div>

{{--                    <div class="mb-3 col-md-12">--}}
{{--                        <p class="font-weight-400 mb-2">Descritivo:</p><textarea rows="3"--}}
{{--                                                                                 class="form-control"--}}
{{--                                                                                 id="descritivo"--}}
{{--                                                                                 name="descritivo"></textarea>--}}
{{--                    </div>--}}
                </div>
                <button type="submit" class="btn float-right btn-primary">Cadastrar</button>
            </div>

                </div>
                </form>
            </div>

            <!-- End tabs -->


            <!-- Gestao Cadastro -->
            <div class="col-md-6">
                <div class="card o-hidden mb-4">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Gestão de Ativos Registrados</h3>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="user_table" class="table dataTable-collapse text-center">
                                <thead>
                                <tr>
                                    <th scope="col">AÇÕES</th>
                                    <th scope="col">ATIVO</th>
                                    <th scope="col">BLOCO</th>
                                    <th scope="col">FASE</th>
                                    <th scope="col">DT. CRIAÇÃO</th>
{{--                                    <th scope="col">STATUS</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ativos as $ativo)
                                <tr>
                                    <td>
                                        <a href="{{ route('ativos.edit',$ativo->id) }}" class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>
                                        <a href="ativos/destroy/{{ $ativo->id }}" class="text-danger mr-2">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </a>
                                    </td>


                                    <td>{{ $ativo->tags }}</td>
                                    <td>
                                        {{ $ativo->bloco_id }}
                                    </td>

                                    <td>{{ $ativo->fase_id }}</td>
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

