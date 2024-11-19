@extends('admin.main_master')

@section('main')
    <div class="col-lg-3">
        <button type="button" class="btn btn-xl btn-outline-dark btn-icon btn-block m-1 mb-3">
            <span class="ul-btn__icon"><i class="i-Shutter"></i> fsddfds</span>
        </button>
    </div>
    <div class="col-lg-3">
        <button type="button" class="btn btn-xl btn-outline-dark btn-icon btn-block m-1 mb-3">
            <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
        </button>
    </div>
    <div class="col-lg-3">
        <button type="button" class="btn btn-xl btn-outline-dark btn-icon btn-block m-1 mb-3">
            <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
        </button>
    </div>
    <div class="col-lg-3">
        <button type="button" class="btn btn-xl btn-outline-dark btn-icon btn-block m-1 mb-3">
            <span class="ul-btn__icon"><i class="i-Shutter"></i></span>
        </button>
    </div>

    <!-- tabs -->
    <div class="col-lg-6 col-md-4 mb-4">
        <form action="ativos/store" method="POST" onsubmit="return getValueOnSubmit();">
            @csrf
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="w-50 float-left card-title m-0">Painel de Ativos</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-3"></h4>

                    <ul class="nav nav-tabs" id="myIconTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="home-icon-tab" data-toggle="tab" href="#homeIcon" role="tab" aria-controls="homeIcon" aria-selected="true"><i class="nav-icon i-Add mr-1"></i>Ativo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-icon-tab" data-toggle="tab" href="#profileIcon" role="tab" aria-controls="profileIcon" aria-selected="false"><i class="nav-icon i-Arrow-Refresh mr-1"></i>Itens do Ativo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-icon-tab" data-toggle="tab" href="#contactIcon" role="tab" aria-controls="contactIcon" aria-selected="false"><i class="nav-icon i-Add-File mr-1"></i> Documentos</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myIconTabContent">
                        <div class="tab-pane fade active show" id="homeIcon" role="tabpanel"
                             aria-labelledby="home-icon-tab">
                            <!-- Cadastro de Ativos -->


                            <div class="row" x-data="{ tags: '' }">
                                <div class="mb-3 col-md-12">
                                    <p class="font-weight-400 mb-2">Tags</p>
                                    <input type="text" id="tags" class="form-control"
                                           value="" name="tags" x-model.fill="tags" readonly="true">
                                    <!--                FS01-BL03-AND02-SL03-AC01                    <input type="text" id="tags"  class="form-control" data-role="tagsinput"  value="TAG-0001">-->
                                </div>

                                <div class="mb-3 col-md-6">
                                    <p class="font-weight-400 mb-2">Nome do Ativo *</p>
                                    <select id="nome_ativo" name="nome_ativo" class="form-control" required="true">
                                        <option value="" selected>---Selecione---</option>
                                        @foreach($assets['artefatos'] as $artefato)
                                            <option
                                                value="{{ strtoupper($artefato->sigla) }}">{{ strtoupper($artefato->sigla).'-'.strtoupper($artefato->nome) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="md-1">
                                    <p class="font-weight-400 mb-2">&nbsp;</p>
                                    <a href="artefatos" class="btn btn-success btn-block" data-toggle="tooltip"
                                       data-placement="top" title="Cadastrar Artefato do Ativo"
                                       data-original-title="Cadastrar Artefato do Ativo">+</a>
                                </div>
                                <div class="mb-3 col">
                                    <p class="font-weight-400 mb-2">Categoria *</p>
                                    <select id="categoria" name="categoria" class="form-control" required="true">
                                        <option value="">---Selecione---</option>
                                        @foreach($assets['categorias'] as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <p class="font-weight-400 mb-2">Modelo</p><input type="text" id="modelo"
                                                                                     name="modelo" placeholder="Modelo"
                                                                                     class="form-control" value="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="font-weight-400 mb-2">N. Série</p><input type="text" id="serie"
                                                                                       name="serie"
                                                                                       placeholder="N. Série"
                                                                                       class="form-control"
                                                                                       value="">
                                </div>
                                <!-- fase-bloco-andar-sala_area -->
                                <div class="mb-3 col-md-3">
                                    <p class="font-weight-400 mb-2">Fase *</p>
                                    <select class="form-control" id="fase" name="fase" required="true" x-ref="fase"
                                            x-on:change="tags = $el.options[$el.selectedIndex].text">
                                        <option value="">---Nenhum---</option>
                                        @foreach($assets['fases'] as $fase)
                                            <option value="{{ $fase->id }}">{{ $fase->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <p class="font-weight-400 mb-2">Loc. Bloco *</p>
                                    <select class="form-control" id="bloco" name="bloco" required="true" x-ref="bloco"
                                            x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                        <option value="">---Nenhum---</option>
                                        @foreach($assets['blocos'] as $bloco)
                                            <option value="{{ $bloco->id }}">{{ $bloco->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <p class="font-weight-400 mb-2">Loc. Andar *</p>
                                    <select class="form-control" id="andar" name="andar" required="true" x-ref="andar"
                                            x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                        <option value="">---Nenhum---</option>
                                        @foreach($assets['andares'] as $andar)
                                            <option value="{{ $andar->id }}">{{ $andar->name }}</option>
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
                                            <option value="{{ $sala_area->id }}">{{ $sala_area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <p class="font-weight-400 mb-2">Upload Arquivos do Ativo</p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="files_ativo" name="files_ativo"
                                                   aria-describedby="inputGroupFileAddon01" multiple>
                                            <label class="custom-file-label" for="inputGroupFile01">Manuais,Imagens,Schemas...</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <p class="font-weight-400 mb-2">Descritivo:</p><textarea rows="3"
                                                                                             class="form-control"
                                                                                             id="descritivo"
                                                                                             name="descritivo"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn float-right btn-primary">Cadastrar</button>


                            <!-- End Cadastro Profissionais -->
                        </div>
                        <div class="tab-pane fade" id="profileIcon" role="tabpanel" aria-labelledby="profile-icon-tab">

                            <p>Itens Selecionados:</p>
                            <div x-data="{ select_valor: '' }">
                                <span  x-text="select_valor"></span>
                                <input type="text" name="select_hidden[]" id="select_hidden" onClick="getValueOnSubmit()" >
                            </div>
                            <div class="listbox-area">

                                <div class="left-area">
                                    <span id="ms_av_l" class="listbox-label">Itens Disponivels:</span>
                                    <ul id="ms_imp_list" tabindex="0" role="listbox" aria-labelledby="ms_av_l" aria-multiselectable="true">
                                        @foreach($assets['itens_ativos'] as $key => $item)
                                            <li id="ms_opt{{ $key+1 }}" role="option" aria-selected="false">
                                                <span class="checkmark" aria-hidden="true"></span>
                                                {{ $item->nome }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <button type="button" id="ex2-add" class="move-right-btn" aria-keyshortcuts="Alt+ArrowRight Enter" aria-disabled="true">
                                        <span class="checkmark" aria-hidden="true"></span>
                                        Adicionar
                                    </button>
                                </div>
                                <div class="right-area" >
                                    <span id="ms_ch_l" class="listbox-label">Itens do Ativo:</span>
                                    <ul id="ms_unimp_list" tabindex="0" role="listbox" aria-labelledby="ms_ch_l" aria-activedescendant="" aria-multiselectable="true">
                                    </ul>
                                    <button type="button" id="ex2-delete" class="move-left-btn" aria-keyshortcuts="Alt+ArrowLeft Delete" aria-disabled="true">
                                        <span class="checkmark" aria-hidden="true"></span>
                                        Remover
                                    </button>
                                </div>
                                <div class="offscreen">Last change: <span aria-live="polite" id="ms_live_region"></span></div>
                            </div>


                            <!-- End Multi-Select ListBox -->
                        </div>
                        <div class="tab-pane fade" id="contactIcon" role="tabpanel" aria-labelledby="contact-icon-tab">
                            <label for="fruits">Fruits</label>
                            <select id="fruits" name="fruits" data-placeholder="Select fruits" multiple data-multi-select>
                                <option value="Apple">Apple</option>
                                <option value="Banana">Banana</option>
                                <option value="Blackberry">Blackberry</option>
                                <option value="Blueberry">Blueberry</option>
                                <option value="Cherry">Cherry</option>
                                <option value="Cranberry">Cranberry</option>
                                <option value="Grapes">Grapes</option>
                                <option value="Kiwi">Kiwi</option>
                                <option value="Mango">Mango</option>
                                <option value="Orange">Orange</option>
                                <option value="Peach">Peach</option>
                                <option value="Pear">Pear</option>
                                <option value="Pineapple">Pineapple</option>
                                <option value="Raspberry">Raspberry</option>
                                <option value="Strawberry">Strawberry</option>
                                <option value="Watermelon">Watermelon</option>
                            </select>
                            <!-- uplodad files -->
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- End tabs -->


    <!-- Gestao Cadastro -->
    <div class="col-md-6">
        <div class="card o-hidden mb-4">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Gestão de Ativos</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table id="user_table" class="table dataTable-collapse text-center">
                        <thead>
                        <tr>
                            <th scope="col">AÇÕES</th>
                            <th scope="col">ATIVO</th>
                            <th scope="col">RESPONSAVEL</th>
                            <th scope="col">CATEGORIA</th>
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
                                    Nenhum
                                </td>

                                <td>{{ $ativo->categorias }}</td>
                                <td>
                                    {{ date_format($ativo->created_at,"d/m/Y") }}
                                </td>
                                {{--                                    <td>--}}
                                {{--                                    @switch($ativo->status)--}}

                                {{--                                        @case('Em Analise')--}}
                                {{--                                                @php $status_color = 'warning'; @endphp--}}
                                {{--                                                @break--}}
                                {{--                                        @case('Aberta')--}}
                                {{--                                            @php $status_color = 'success'; @endphp--}}
                                {{--                                            @break--}}
                                {{--                                        @case('Em Andamento')--}}
                                {{--                                            @php $status_color = 'waiting'; @endphp--}}
                                {{--                                            @break--}}
                                {{--                                        @case('Em Espera')--}}
                                {{--                                            @php $status_color = 'danger'; @endphp--}}
                                {{--                                            @break--}}
                                {{--                                        @case('Fechada')--}}
                                {{--                                            @php $status_color = 'outline-dark'; @endphp--}}
                                {{--                                            @break--}}
                                {{--                                        @default--}}
                                {{--                                            @php $status_color = 'outline-danger'; @endphp--}}
                                {{--                                    @endswitch--}}
                                {{--                                        <span class="badge badge-{{ $status_color }}">{{ $ativo->status }}</span></td>--}}
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
