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
                    <!-- fase-bloco-andar-sala_area -->
                    <div class="mb-3 col-md-3">
                        <p class="font-weight-400 mb-2"> Local 01 *</p>
                        <select class="form-control" id="fase" name="fase" required="true" x-ref="fase"
                                x-on:change="tags = $el.options[$el.selectedIndex].text">
                            <option value="">---Nenhum---</option>
                            @foreach($assets['ativos_location']->where('tipo','fase') as $fase)
                                <option value="{{ $fase->id }}">{{ $fase->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <p class="font-weight-400 mb-2">Local 02 *</p>
                        <select class="form-control" id="bloco" name="bloco" required="true" x-ref="bloco"
                                x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                            <option value="">---Nenhum---</option>
                            @foreach($assets['ativos_location']->where('tipo','bloco') as $bloco)
                                <option value="{{ $bloco->id }}">{{ $bloco->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <p class="font-weight-400 mb-2">Local 03 *</p>
                        <select class="form-control" id="andar" name="andar" required="true" x-ref="andar"
                                x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                            <option value="">---Nenhum---</option>
                            @foreach($assets['ativos_location']->where('tipo','andar') as $andar)
                                <option value="{{ $andar->id }}">{{ $andar->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <p class="font-weight-400 mb-2">Local 04 *</p>
                        <select class="form-control" id="sala_area" name="sala_area" required="true"
                                x-ref="sala_area"
                                x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $refs.andar.options[$refs.andar.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                            <option value="">---Nenhum---</option>
                            @foreach($assets['ativos_location']->where('tipo','sala_area') as $sala_area)
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

                                    <!-- test -->
{{--                                    <td >--}}
{{--                                        --}}{{--                                        <a href="{{ route('ativos.edit',$ativo->id) }}"--}}
{{--                                        --}}{{--                                           class="btn btn-danger m-1">--}}
{{--                                        --}}{{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"--}}
{{--                                        --}}{{--                                                 fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">--}}
{{--                                        --}}{{--                                                <path--}}
{{--                                        --}}{{--                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>--}}
{{--                                        --}}{{--                                                <path--}}
{{--                                        --}}{{--                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>--}}
{{--                                        --}}{{--                                            </svg>--}}
{{--                                        --}}{{--                                        </a>--}}
{{--                                        --}}{{--                                        <a href="{{ route('ativos.edit',$ativo->id) }}"--}}
{{--                                        --}}{{--                                           class="btn btn-success m-1">--}}
{{--                                        --}}{{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"--}}
{{--                                        --}}{{--                                                 fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">--}}
{{--                                        --}}{{--                                                <path--}}
{{--                                        --}}{{--                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>--}}
{{--                                        --}}{{--                                                <path fill-rule="evenodd"--}}
{{--                                        --}}{{--                                                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>--}}
{{--                                        --}}{{--                                            </svg>--}}
{{--                                        --}}{{--                                        </a>--}}
{{--                                        <a href="{{ route('ativos.edit',$ativo->id) }}" class="mr-1" title="Editar Ativo">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"--}}
{{--                                                 fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">--}}
{{--                                                <path--}}
{{--                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>--}}
{{--                                                <path fill-rule="evenodd"--}}
{{--                                                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
{{--                                        <a href="{{ route('ativos.destroy', $ativo->id) }}" title="Deletar Ativo">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"--}}
{{--                                                 fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">--}}
{{--                                                <path--}}
{{--                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>--}}
{{--                                                <path--}}
{{--                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}

                                    <!-- end test -->

                                    <td>{{ $ativo->tags }}</td>
                                    <td>
                                        @foreach($assets['ativos_location'] as $ativo_location)
                                            @if($ativo->bloco_id == $ativo_location->id)
                                                {{  $ativo_location->nome }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($assets['ativos_location'] as $ativo_location)
                                            @if($ativo->fase_id == $ativo_location->id)
                                                {{  $ativo_location->nome }}
                                            @endif
                                        @endforeach
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

