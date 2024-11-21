@extends('admin.main_master')

@section('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

<!-- row -->
@section('main')
    <!-- Editar Ativo -->
    <div class="col-md">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Editar Ativo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ativos.update',$ativo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="ativo_modelo_id" name="ativo_modelo_id" value="{{ $ativo->ativo_modelo_id }}">
                    <div class="row" x-data="{ tags: '' }">
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">TAG: {{ $ativo->tags }}</p>
                            <input type="text" id="tags" class="form-control" value="" name="tags" x-model.fill="tags" readonly>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Sigla do Ativo *</p>
                            <input type="text" id="sigla_ativo" class="form-control" value="{{ strtoupper($ativo->sigla) }}" name="sigla_ativo" readonly>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Nome do Ativo *</p>
                            <input type="text" id="nome_ativo" class="form-control" value="{{ strtoupper($ativo->nome) }}" name="nome_ativo" readonly>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Modelo</p><input type="text" id="modelo" name="modelo"  placeholder="Modelo"
                                                                             class="form-control" value="{{ $ativo->modelo }}">
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">N. Série</p><input type="text" id="serie" name="serie"  placeholder="N. Série"
                                                                               class="form-control"
                                                                               value="{{ $ativo->serie }}">
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Categoria *</p>
                            <select id="categoria" name="categoria" class="form-control" required="true">
                                <option value="">---Selecione---</option>
                                @foreach($assets['categorias'] as $categoria)
                                    <option value="{{ $categoria->id }}" {{ ($categoria->id == $ativo->categoria_id) ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- fase-bloco-andar-sala_area -->
                        <div class="mb-3 col-md-3">
                            <p class="font-weight-400 mb-2">Fase *</p>
                            <select class="form-control" id="fase" name="fase" required="true" x-ref="fase" x-on:change="tags = $el.options[$el.selectedIndex].text">
                                <option value="">---Nenhum---</option>
                                @foreach($assets['ativos_location']->where('tipo','fase') as $fase)
                                    <option value="{{ $fase->id }}" {{ ($fase->id == $ativo->fase_id) ? 'selected' : '' }}>{{ $fase->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <p class="font-weight-400 mb-2">Loc. Bloco *</p>
                            <select class="form-control" id="bloco" name="bloco" required="true" x-ref="bloco" x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                <option value="">---Nenhum---</option>
                                @foreach($assets['ativos_location']->where('tipo','bloco') as $bloco)
                                    <option value="{{ $bloco->id }}" {{ ($bloco->id == $ativo->bloco_id) ? 'selected' : '' }}>{{ $bloco->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <p class="font-weight-400 mb-2">Loc. Andar *</p>
                            <select class="form-control" id="andar" name="andar"  required="true" x-ref="andar" x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                <option value="">---Nenhum---</option>
                                @foreach($assets['ativos_location']->where('tipo','andar') as $andar)
                                    <option value="{{ $andar->id }}" {{ ($andar->id == $ativo->andar_id) ? 'selected' : '' }}>{{ $andar->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <p class="font-weight-400 mb-2">Loc. Sala/Área *</p>
                            <select class="form-control" id="sala_area" name="sala_area" required="true" x-ref="sala_area" x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $refs.andar.options[$refs.andar.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                <option value="">---Nenhum---</option>
                                @foreach($assets['ativos_location']->where('tipo','sala_area') as $sala_area)
                                    <option value="{{ $sala_area->id }}" {{ ($sala_area->id == $ativo->sala_area_id) ? 'selected' : '' }}>{{ $sala_area->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <p class="font-weight-400 mb-2" >Descritivo:</p><textarea rows="3" class="form-control" id="descritivo" name="descritivo">{{ $ativo->descritivo }}</textarea>
                        </div>
                    </div>
                    <a href="{{ route('ativos') }}" class="btn float-right btn-primary ml-3" >Voltar</a>
                    <button type="submit" class="btn float-right btn-primary ml-3">EDITAR</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Editar  -->
@endsection

