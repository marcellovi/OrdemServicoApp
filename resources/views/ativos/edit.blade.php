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
                            <p class="font-weight-400 mb-2">Local 01 *</p>
                            <select class="form-control" id="fase" name="fase" required="true" x-ref="fase" x-on:change="tags = $el.options[$el.selectedIndex].text">
                                <option value="">---Nenhum---</option>
                                @foreach($assets['ativos_location']->where('tipo','fase') as $fase)
                                    <option value="{{ $fase->id }}" {{ ($fase->id == $ativo->fase_id) ? 'selected' : '' }}>{{ $fase->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <p class="font-weight-400 mb-2">Local 02 *</p>
                            <select class="form-control" id="bloco" name="bloco" required="true" x-ref="bloco" x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                <option value="">---Nenhum---</option>
                                @foreach($assets['ativos_location']->where('tipo','bloco') as $bloco)
                                    <option value="{{ $bloco->id }}" {{ ($bloco->id == $ativo->bloco_id) ? 'selected' : '' }}>{{ $bloco->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <p class="font-weight-400 mb-2">Local 03 *</p>
                            <select class="form-control" id="andar" name="andar"  required="true" x-ref="andar" x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                <option value="">---Nenhum---</option>
                                @foreach($assets['ativos_location']->where('tipo','andar') as $andar)
                                    <option value="{{ $andar->id }}" {{ ($andar->id == $ativo->andar_id) ? 'selected' : '' }}>{{ $andar->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <p class="font-weight-400 mb-2">Local 04 *</p>
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
                    <a href="{{ route('ativos') }}" class="btn float-right btn-primary ml-3" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        Voltar</a>
                    <button type="submit" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                            <path d="M11 2H9v3h2z"/>
                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                        </svg>&nbsp;
                        Salvar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Editar  -->
@endsection

