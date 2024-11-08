<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de O.S</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/vendor/datatables.min.css">
    <link rel="stylesheet" href="assets/styles/css/themes/lite-purple.css">
    <link rel="stylesheet" href="assets/styles/vendor/perfect-scrollbar.css">
    <style>
        div.scroll {
            max-height: 500px;
            overflow: scroll;
            overflow-x: auto;
        }
    </style>

    <!-- Multi-Select ListBox CSS -->
    <style>
        .listbox-area {
            display: grid;
            grid-gap: 2em;
            grid-template-columns: repeat(2, 1fr);
            padding: 20px;
            border: 1px solid #aaa;
            border-radius: 4px;
            background: #eee;
        }

        [role="listbox"] {
            margin: 1em 0 0;
            padding: 0;
            min-height: 18em;
            border: 1px solid #aaa;
            background: white;
        }

        [role="listbox"]#ss_elem_list {
            position: relative;
            max-height: 18em;
            overflow-y: auto;
        }

        [role="listbox"] + *,
        .listbox-label + * {
            margin-top: 1em;
        }

        [role="group"] {
            margin: 0;
            padding: 0;
        }

        [role="group"] > [role="presentation"] {
            display: block;
            margin: 0;
            padding: 0 0.5em;
            font-weight: bold;
            line-height: 2;
            background-color: #ccc;
        }

        [role="option"] {
            position: relative;
            display: block;
            margin: 2px;
            padding: 2px 1em 2px 1.5em;
            line-height: 1.8em;
            cursor: pointer;
        }

        [role="listbox"]:focus [role="option"].focused {
            background: #bde4ff;
        }

        [role="listbox"]:focus [role="option"].focused,
        [role="option"]:hover {
            outline: 2px solid currentcolor;
        }

        .move-right-btn span.checkmark::after {
            content: " →";
        }

        .move-left-btn span.checkmark::before {
            content: "← ";
        }

        [role="option"][aria-selected="true"] span.checkmark::before {
            position: absolute;
            left: 0.5em;
            content: "✓";
        }

        button[aria-haspopup="listbox"] {
            position: relative;
            padding: 5px 10px;
            width: 150px;
            border-radius: 0;
            text-align: left;
        }

        button[aria-haspopup="listbox"]::after {
            position: absolute;
            right: 5px;
            top: 10px;
            width: 0;
            height: 0;
            border: 8px solid transparent;
            border-top-color: currentcolor;
            border-bottom: 0;
            content: "";
        }

        button[aria-haspopup="listbox"][aria-expanded="true"]::after {
            position: absolute;
            right: 5px;
            top: 10px;
            width: 0;
            height: 0;
            border: 8px solid transparent;
            border-top: 0;
            border-bottom-color: currentcolor;
            content: "";
        }

        button[aria-haspopup="listbox"] + [role="listbox"] {
            position: absolute;
            margin: 0;
            width: 9.5em;
            max-height: 10em;
            border-top: 0;
            overflow-y: auto;
        }

        [role="toolbar"] {
            display: flex;
        }

        [role="toolbar"] > * {
            border: 1px solid #aaa;
            background: #ccc;
        }

        [role="toolbar"] > [aria-disabled="false"]:focus {
            background-color: #eee;
        }

        button {
            font-size: inherit;
        }

        button[aria-disabled="true"] {
            opacity: 0.5;
        }

        .annotate {
            color: #366ed4;
            font-style: italic;
        }

        .hidden {
            display: none;
        }

        .offscreen {
            position: absolute;
            width: 1px;
            height: 1px;
            overflow: hidden;
            clip: rect(1px 1px 1px 1px);
            clip: rect(1px, 1px, 1px, 1px);
            font-size: 14px;
            white-space: nowrap;
        }
    </style>


    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large clearfix">

    <!-- Top Menu and Left Side Menu -->
    @include ('admin.body.sidemenu');
    <!--=============== Left side End ================-->

    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column">

        <!-- -->
        <div class="breadcrumb">
            <h1 class="mr-2">Sistema de OS</h1>
            <ul>
                <li><a href="">Dashboard</a></li>
                <li></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if( session('type') == $msg)
            <div id="msg_alert" class="alert alert-card alert-{{ $msg }}" role="alert">
                <strong class="text-capitalize">{{ session('status') }}!</strong> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
                @endif
            @endforeach


        <div class="row">



            <!-- tabs -->
            <div class="col-lg-6 col-md-4 mb-4">
                <form action="ativos/store" method="POST" onsubmit="return getValueOnSubmit();">
                    @csrf
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Cadastro de Ativos</h3>
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
                            <input type="hidden" name="select_hidden[]" id="select_hidden" x-text="select_valor" >
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
                                <ul id="ms_unimp_list" x-model="select_valor"  tabindex="0" role="listbox" aria-labelledby="ms_ch_l" aria-activedescendant="" aria-multiselectable="true">
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

{{--                        <form action="#" class="dropzone dz-clickable" id="multple-file-upload">--}}
{{--                            <div class="dz-default dz-message"><span></span></div>--}}
{{--                        </form>--}}
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


        </div>
        <!-- end of row-->
    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->

<!-- ============ Search UI Start ============= -->
<div class="search-ui">
    <div class="search-header">
        <img src="./assets/images/er_profile.png" alt="" class="logo">
        <button class="search-close btn btn-icon bg-transparent float-right mt-2">
            <i class="i-Close-Window text-22 text-muted"></i>
        </button>
    </div>

    <input type="text" placeholder="Type here" class="search-input" autofocus>

    <div class="search-title">
        <span class="text-muted">Search results</span>
    </div>

    <div class="search-results list-horizontal">
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="./assets/images/products/headphone-1.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div
                        class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $300
                            <del class="text-secondary">$400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-danger">Sale</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="./assets/images/products/headphone-2.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div
                        class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $300
                            <del class="text-secondary">$400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="./assets/images/products/headphone-3.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div
                        class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $300
                            <del class="text-secondary">$400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="./assets/images/products/headphone-4.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div
                        class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $300
                            <del class="text-secondary">$400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- PAGINATION CONTROL -->
    <div class="col-md-12 mt-5 text-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination d-inline-flex">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- ============ Search UI End ============= -->

<script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/vendor/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendor/echarts.min.js"></script>
<script src="assets/js/vendor/datatables.min.js"></script>

<script src="assets/js/es5/echart.options.min.js"></script>
<script src="assets/js/es5/dashboard.v2.script.min.js"></script>

<script src="assets/js/es5/script.min.js"></script>
<script src="assets/js/es5/sidebar.large.script.min.js"></script>

<script src="assets/js/vendor/apexcharts.min.js"></script>
<script src="assets/js/vendor/echarts.min.js"></script>
<script src="assets/js/es5/echart.options.min.js"></script>

<!-- Taginput -->
<script
    src="https://htmlstream.com/preview/front-v2.9.0/assets/vendor/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>

<!-- Session fade after some time -->
<script type="text/javascript">
    window.setTimeout("document.getElementById('msg_alert').style.display='none';", 4000);
</script>
<script>
    /*
 *   This content is licensed according to the W3C Software License at
 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 */

    'use strict';

    /**
     * @namespace aria
     * @description
     * The aria namespace is used to support sharing class definitions between example files
     * without causing eslint errors for undefined classes
     */
    var aria = aria || {};

    /**
     * @class
    * @description
     *  Listbox object representing the state and interactions for a listbox widget
     * @param listboxNode
     *  The DOM node pointing to the listbox
     */

    aria.Listbox = class Listbox {
        constructor(listboxNode) {
            this.listboxNode = listboxNode;
            this.activeDescendant = this.listboxNode.getAttribute(
                'aria-activedescendant'
            );
            this.multiselectable = this.listboxNode.hasAttribute(
                'aria-multiselectable'
            );
            this.moveUpDownEnabled = false;
            this.siblingList = null;
            this.startRangeIndex = 0;
            this.upButton = null;
            this.downButton = null;
            this.moveButton = null;
            this.keysSoFar = '';
            this.handleFocusChange = function () {};
            this.handleItemChange = function () {};
            this.registerEvents();
        }

        registerEvents() {
            this.listboxNode.addEventListener('focus', this.setupFocus.bind(this));
            this.listboxNode.addEventListener('keydown', this.checkKeyPress.bind(this));
            this.listboxNode.addEventListener('click', this.checkClickItem.bind(this));

            if (this.multiselectable) {
                this.listboxNode.addEventListener(
                    'mousedown',
                    this.checkMouseDown.bind(this)
                );
            }
        }

        setupFocus() {
            if (this.activeDescendant) {
                const listitem = document.getElementById(this.activeDescendant);
                listitem.scrollIntoView({ block: 'nearest', inline: 'nearest' });
            }
        }

        focusFirstItem() {
            var firstItem = this.listboxNode.querySelector('[role="option"]');

            if (firstItem) {
                this.focusItem(firstItem);
            }
        }

        focusLastItem() {
            const itemList = this.listboxNode.querySelectorAll('[role="option"]');

            if (itemList.length) {
                this.focusItem(itemList[itemList.length - 1]);
            }
        }

        checkKeyPress(evt) {
            const lastActiveId = this.activeDescendant;
            const allOptions = this.listboxNode.querySelectorAll('[role="option"]');
            const currentItem =
                document.getElementById(this.activeDescendant) || allOptions[0];
            let nextItem = currentItem;

            if (!currentItem) {
                return;
            }

            switch (evt.key) {
                case 'PageUp':
                case 'PageDown':
                    evt.preventDefault();
                    if (this.moveUpDownEnabled) {
                        if (evt.key === 'PageUp') {
                            this.moveUpItems();
                        } else {
                            this.moveDownItems();
                        }
                    }

                    break;
                case 'ArrowUp':
                case 'ArrowDown':
                    evt.preventDefault();
                    if (!this.activeDescendant) {
                        // focus first option if no option was previously focused, and perform no other actions
                        this.focusItem(currentItem);
                        break;
                    }

                    if (this.moveUpDownEnabled && evt.altKey) {
                        evt.preventDefault();
                        if (evt.key === 'ArrowUp') {
                            this.moveUpItems();
                        } else {
                            this.moveDownItems();
                        }
                        this.updateScroll();
                        return;
                    }

                    if (evt.key === 'ArrowUp') {
                        nextItem = this.findPreviousOption(currentItem);
                    } else {
                        nextItem = this.findNextOption(currentItem);
                    }

                    if (nextItem && this.multiselectable && event.shiftKey) {
                        this.selectRange(this.startRangeIndex, nextItem);
                    }

                    if (nextItem) {
                        this.focusItem(nextItem);
                    }

                    break;

                case 'Home':
                    evt.preventDefault();
                    this.focusFirstItem();

                    if (this.multiselectable && evt.shiftKey && evt.ctrlKey) {
                        this.selectRange(this.startRangeIndex, 0);
                    }
                    break;

                case 'End':
                    evt.preventDefault();
                    this.focusLastItem();

                    if (this.multiselectable && evt.shiftKey && evt.ctrlKey) {
                        this.selectRange(this.startRangeIndex, allOptions.length - 1);
                    }
                    break;

                case 'Shift':
                    this.startRangeIndex = this.getElementIndex(currentItem, allOptions);
                    break;

                case ' ':
                    evt.preventDefault();
                    this.toggleSelectItem(nextItem);
                    break;

                case 'Backspace':
                case 'Delete':
                case 'Enter':
                    if (!this.moveButton) {
                        return;
                    }

                    var keyshortcuts = this.moveButton.getAttribute('aria-keyshortcuts');
                    if (evt.key === 'Enter' && keyshortcuts.indexOf('Enter') === -1) {
                        return;
                    }
                    if (
                        (evt.key === 'Backspace' || evt.key === 'Delete') &&
                        keyshortcuts.indexOf('Delete') === -1
                    ) {
                        return;
                    }

                    evt.preventDefault();

                    var nextUnselected = nextItem.nextElementSibling;
                    while (nextUnselected) {
                        if (nextUnselected.getAttribute('aria-selected') != 'true') {
                            break;
                        }
                        nextUnselected = nextUnselected.nextElementSibling;
                    }
                    if (!nextUnselected) {
                        nextUnselected = nextItem.previousElementSibling;
                        while (nextUnselected) {
                            if (nextUnselected.getAttribute('aria-selected') != 'true') {
                                break;
                            }
                            nextUnselected = nextUnselected.previousElementSibling;
                        }
                    }

                    this.moveItems();

                    if (!this.activeDescendant && nextUnselected) {
                        this.focusItem(nextUnselected);
                    }
                    break;

                case 'A':
                case 'a':
                    // handle control + A
                    if (evt.ctrlKey || evt.metaKey) {
                        if (this.multiselectable) {
                            this.selectRange(0, allOptions.length - 1);
                        }
                        evt.preventDefault();
                        break;
                    }
                // fall through
                default:
                    if (evt.key.length === 1) {
                        const itemToFocus = this.findItemToFocus(evt.key.toLowerCase());
                        if (itemToFocus) {
                            this.focusItem(itemToFocus);
                        }
                    }
                    break;
            }

            if (this.activeDescendant !== lastActiveId) {
                this.updateScroll();
            }
        }

        findItemToFocus(character) {
            const itemList = this.listboxNode.querySelectorAll('[role="option"]');
            let searchIndex = 0;

            if (!this.keysSoFar) {
                for (let i = 0; i < itemList.length; i++) {
                    if (itemList[i].getAttribute('id') == this.activeDescendant) {
                        searchIndex = i;
                    }
                }
            }

            this.keysSoFar += character;
            this.clearKeysSoFarAfterDelay();

            let nextMatch = this.findMatchInRange(
                itemList,
                searchIndex + 1,
                itemList.length
            );

            if (!nextMatch) {
                nextMatch = this.findMatchInRange(itemList, 0, searchIndex);
            }
            return nextMatch;
        }

        /* Return the index of the passed element within the passed array, or null if not found */
        getElementIndex(option, options) {
            const allOptions = Array.prototype.slice.call(options); // convert to array
            const optionIndex = allOptions.indexOf(option);

            return typeof optionIndex === 'number' ? optionIndex : null;
        }

        /* Return the next listbox option, if it exists; otherwise, returns null */
        findNextOption(currentOption) {
            const allOptions = Array.prototype.slice.call(
                this.listboxNode.querySelectorAll('[role="option"]')
            ); // get options array
            const currentOptionIndex = allOptions.indexOf(currentOption);
            let nextOption = null;

            if (currentOptionIndex > -1 && currentOptionIndex < allOptions.length - 1) {
                nextOption = allOptions[currentOptionIndex + 1];
            }

            return nextOption;
        }

        /* Return the previous listbox option, if it exists; otherwise, returns null */
        findPreviousOption(currentOption) {
            const allOptions = Array.prototype.slice.call(
                this.listboxNode.querySelectorAll('[role="option"]')
            ); // get options array
            const currentOptionIndex = allOptions.indexOf(currentOption);
            let previousOption = null;

            if (currentOptionIndex > -1 && currentOptionIndex > 0) {
                previousOption = allOptions[currentOptionIndex - 1];
            }

            return previousOption;
        }

        clearKeysSoFarAfterDelay() {
            if (this.keyClear) {
                clearTimeout(this.keyClear);
                this.keyClear = null;
            }
            this.keyClear = setTimeout(
                function () {
                    this.keysSoFar = '';
                    this.keyClear = null;
                }.bind(this),
                500
            );
        }

        findMatchInRange(list, startIndex, endIndex) {
            // Find the first item starting with the keysSoFar substring, searching in
            // the specified range of items
            for (let n = startIndex; n < endIndex; n++) {
                const label = list[n].innerText;
                if (label && label.toLowerCase().indexOf(this.keysSoFar) === 0) {
                    return list[n];
                }
            }
            return null;
        }

        checkClickItem(evt) {
            if (evt.target.getAttribute('role') !== 'option') {
                return;
            }

            this.focusItem(evt.target);
            this.toggleSelectItem(evt.target);
            this.updateScroll();

            if (this.multiselectable && evt.shiftKey) {
                this.selectRange(this.startRangeIndex, evt.target);
            }
        }

        /**
         * Prevent text selection on shift + click for multi-select listboxes
         *
         * @param evt
         */
        checkMouseDown(evt) {
            if (
                this.multiselectable &&
                evt.shiftKey &&
                evt.target.getAttribute('role') === 'option'
            ) {
                evt.preventDefault();
            }
        }

        /**
         * @description
         *  Toggle the aria-selected value
         * @param element
         *  The element to select
         */
        toggleSelectItem(element) {
            if (this.multiselectable) {
                element.setAttribute(
                    'aria-selected',
                    element.getAttribute('aria-selected') === 'true' ? 'false' : 'true'
                );

                this.updateMoveButton();
            }
        }

        /**
         * @description
         *  Defocus the specified item
         * @param element
         *  The element to defocus
         */
        defocusItem(element) {
            if (!element) {
                return;
            }
            if (!this.multiselectable) {
                element.removeAttribute('aria-selected');
            }
            element.classList.remove('focused');
        }

        /**
         * @description
         *  Focus on the specified item
         * @param element
         *  The element to focus
         */
        focusItem(element) {
            this.defocusItem(document.getElementById(this.activeDescendant));
            if (!this.multiselectable) {
                element.setAttribute('aria-selected', 'true');
            }
            element.classList.add('focused');
            this.listboxNode.setAttribute('aria-activedescendant', element.id);
            this.activeDescendant = element.id;

            if (!this.multiselectable) {
                this.updateMoveButton();
            }

            this.checkUpDownButtons();
            this.handleFocusChange(element);
        }

        /**
         * Helper function to check if a number is within a range; no side effects.
         *
         * @param index
         * @param start
         * @param end
         * @returns {boolean}
         */
        checkInRange(index, start, end) {
            const rangeStart = start < end ? start : end;
            const rangeEnd = start < end ? end : start;

            return index >= rangeStart && index <= rangeEnd;
        }

        /**
         * Select a range of options
         *
         * @param start
         * @param end
         */
        selectRange(start, end) {
            // get start/end indices
            const allOptions = this.listboxNode.querySelectorAll('[role="option"]');
            const startIndex =
                typeof start === 'number'
                    ? start
                    : this.getElementIndex(start, allOptions);
            const endIndex =
                typeof end === 'number' ? end : this.getElementIndex(end, allOptions);

            for (let index = 0; index < allOptions.length; index++) {
                const selected = this.checkInRange(index, startIndex, endIndex);
                allOptions[index].setAttribute('aria-selected', selected + '');
            }

            this.updateMoveButton();
        }

        /**
         * Check for selected options and update moveButton, if applicable
         */
        updateMoveButton() {
            if (!this.moveButton) {
                return;
            }

            if (this.listboxNode.querySelector('[aria-selected="true"]')) {
                this.moveButton.setAttribute('aria-disabled', 'false');
            } else {
                this.moveButton.setAttribute('aria-disabled', 'true');
            }
        }

        /**
         * Check if the selected option is in view, and scroll if not
         */
        updateScroll() {
            const selectedOption = document.getElementById(this.activeDescendant);
            if (selectedOption) {
                const scrollBottom =
                    this.listboxNode.clientHeight + this.listboxNode.scrollTop;
                const elementBottom =
                    selectedOption.offsetTop + selectedOption.offsetHeight;
                if (elementBottom > scrollBottom) {
                    this.listboxNode.scrollTop =
                        elementBottom - this.listboxNode.clientHeight;
                } else if (selectedOption.offsetTop < this.listboxNode.scrollTop) {
                    this.listboxNode.scrollTop = selectedOption.offsetTop;
                }
                selectedOption.scrollIntoView({ block: 'nearest', inline: 'nearest' });
            }
        }

        /**
         * @description
         *  Enable/disable the up/down arrows based on the activeDescendant.
         */
        checkUpDownButtons() {
            const activeElement = document.getElementById(this.activeDescendant);

            if (!this.moveUpDownEnabled) {
                return;
            }

            if (!activeElement) {
                this.upButton.setAttribute('aria-disabled', 'true');
                this.downButton.setAttribute('aria-disabled', 'true');
                return;
            }

            if (this.upButton) {
                if (activeElement.previousElementSibling) {
                    this.upButton.setAttribute('aria-disabled', false);
                } else {
                    this.upButton.setAttribute('aria-disabled', 'true');
                }
            }

            if (this.downButton) {
                if (activeElement.nextElementSibling) {
                    this.downButton.setAttribute('aria-disabled', false);
                } else {
                    this.downButton.setAttribute('aria-disabled', 'true');
                }
            }
        }

        /**
         * @description
         *  Add the specified items to the listbox. Assumes items are valid options.
         * @param items
         *  An array of items to add to the listbox
         */
        addItems(items) {
            if (!items || !items.length) {
                return;
            }

            items.forEach(
                function (item) {
                    this.defocusItem(item);
                    this.toggleSelectItem(item);
                    this.listboxNode.append(item);
                }.bind(this)
            );

            if (!this.activeDescendant) {
                this.focusItem(items[0]);
            }

            this.handleItemChange('added', items);
        }

        /**
         * @description
         *  Remove all of the selected items from the listbox; Removes the focused items
         *  in a single select listbox and the items with aria-selected in a multi
         *  select listbox.
         * @returns {Array}
         *  An array of items that were removed from the listbox
         */
        deleteItems() {
            let itemsToDelete;

            if (this.multiselectable) {
                itemsToDelete = this.listboxNode.querySelectorAll(
                    '[aria-selected="true"]'
                );
            } else if (this.activeDescendant) {
                itemsToDelete = [document.getElementById(this.activeDescendant)];
            }

            if (!itemsToDelete || !itemsToDelete.length) {
                return [];
            }

            itemsToDelete.forEach(
                function (item) {
                    item.remove();

                    if (item.id === this.activeDescendant) {
                        this.clearActiveDescendant();
                    }
                }.bind(this)
            );

            this.handleItemChange('removed', itemsToDelete);

            return itemsToDelete;
        }

        clearActiveDescendant() {
            this.activeDescendant = null;
            this.listboxNode.setAttribute('aria-activedescendant', null);

            this.updateMoveButton();
            this.checkUpDownButtons();
        }

        /**
         * @description
         *  Shifts the currently focused item up on the list. No shifting occurs if the
         *  item is already at the top of the list.
         */
        moveUpItems() {
            if (!this.activeDescendant) {
                return;
            }

            const currentItem = document.getElementById(this.activeDescendant);
            const previousItem = currentItem.previousElementSibling;

            if (previousItem) {
                this.listboxNode.insertBefore(currentItem, previousItem);
                this.handleItemChange('moved_up', [currentItem]);
            }

            this.checkUpDownButtons();
        }

        /**
         * @description
         *  Shifts the currently focused item down on the list. No shifting occurs if
         *  the item is already at the end of the list.
         */
        moveDownItems() {
            if (!this.activeDescendant) {
                return;
            }

            var currentItem = document.getElementById(this.activeDescendant);
            var nextItem = currentItem.nextElementSibling;

            if (nextItem) {
                this.listboxNode.insertBefore(nextItem, currentItem);
                this.handleItemChange('moved_down', [currentItem]);
            }

            this.checkUpDownButtons();
        }

        /**
         * @description
         *  Delete the currently selected items and add them to the sibling list.
         */
        moveItems() {
            if (!this.siblingList) {
                return;
            }

            var itemsToMove = this.deleteItems();
            this.siblingList.addItems(itemsToMove);
        }

        /**
         * @description
         *  Enable Up/Down controls to shift items up and down.
         * @param upButton
         *   Up button to trigger up shift
         * @param downButton
         *   Down button to trigger down shift
         */
        enableMoveUpDown(upButton, downButton) {
            this.moveUpDownEnabled = true;
            this.upButton = upButton;
            this.downButton = downButton;
            upButton.addEventListener('click', this.moveUpItems.bind(this));
            downButton.addEventListener('click', this.moveDownItems.bind(this));
        }

        /**
         * @description
         *  Enable Move controls. Moving removes selected items from the current
         *  list and adds them to the sibling list.
         * @param button
         *   Move button to trigger delete
         * @param siblingList
         *   Listbox to move items to
         */
        setupMove(button, siblingList) {
            this.siblingList = siblingList;
            this.moveButton = button;
            button.addEventListener('click', this.moveItems.bind(this));
        }

        setHandleItemChange(handlerFn) {
            this.handleItemChange = handlerFn;
        }

        setHandleFocusChange(focusChangeHandler) {
            this.handleFocusChange = focusChangeHandler;
        }
    };
    /*
     *   This content is licensed according to the W3C Software License at
     *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
     */

    'use strict';

    /**
     * @namespace aria
     * @description
     * The aria namespace is used to support sharing class definitions between example files
     * without causing eslint errors for undefined classes
     */
    var aria = aria || {};

    /**
     * @class
    * @description
     *  Toolbar object representing the state and interactions for a toolbar widget
     * @param toolbarNode
     *  The DOM node pointing to the toolbar
     */

    aria.Toolbar = class Toolbar {
        constructor(toolbarNode) {
            this.toolbarNode = toolbarNode;
            this.items = this.toolbarNode.querySelectorAll('.toolbar-item');
            this.selectedItem = this.toolbarNode.querySelector('.selected');
            this.registerEvents();
        }

        /**
         * @description
         *  Register events for the toolbar interactions
         */
        registerEvents() {
            this.toolbarNode.addEventListener(
                'keydown',
                this.checkFocusChange.bind(this)
            );
            this.toolbarNode.addEventListener('click', this.checkClickItem.bind(this));
        }

        /**
         * @description
         *  Handle various keyboard commands to move focus:
         *    LEFT:  Previous button
         *    RIGHT: Next button
         *    HOME:  First button
         *    END:   Last button
         * @param evt
         *  The keydown event object
         */
        checkFocusChange(evt) {
            let nextIndex, nextItem;

            // Do not move focus if any modifier keys pressed
            if (!evt.shiftKey && !evt.metaKey && !evt.altKey && !evt.ctrlKey) {
                switch (evt.key) {
                    case 'ArrowLeft':
                    case 'ArrowRight':
                        nextIndex = Array.prototype.indexOf.call(
                            this.items,
                            this.selectedItem
                        );
                        nextIndex = evt.key === 'ArrowLeft' ? nextIndex - 1 : nextIndex + 1;
                        nextIndex = Math.max(Math.min(nextIndex, this.items.length - 1), 0);

                        nextItem = this.items[nextIndex];
                        break;

                    case 'End':
                        nextItem = this.items[this.items.length - 1];
                        break;

                    case 'Home':
                        nextItem = this.items[0];
                        break;
                }

                if (nextItem) {
                    this.selectItem(nextItem);
                    this.focusItem(nextItem);
                    evt.stopPropagation();
                    evt.preventDefault();
                }
            }
        }

        /**
         * @description
         *  Selects a toolbar item if it is clicked
         * @param evt
         *  The click event object
         */
        checkClickItem(evt) {
            if (evt.target.classList.contains('toolbar-item')) {
                this.selectItem(evt.target);
            }
        }

        /**
         * @description
         *  Deselect the specified item
         * @param element
         *  The item to deselect
         */
        deselectItem(element) {
            element.classList.remove('selected');
            element.setAttribute('aria-selected', 'false');
            element.setAttribute('tabindex', '-1');
        }

        /**
         * @description
         *  Deselect the currently selected item and select the specified item
         * @param element
         *  The item to select
         */
        selectItem(element) {
            this.deselectItem(this.selectedItem);
            element.classList.add('selected');
            element.setAttribute('aria-selected', 'true');
            element.setAttribute('tabindex', '0');
            this.selectedItem = element;
        }

        /**
         * @description
         *  Focus on the specified item
         * @param element
         *  The item to focus on
         */
        focusItem(element) {
            element.focus();
        }
    };
    /*
     *   This content is licensed according to the W3C Software License at
     *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
     */

    'use strict';

    /**
     * @namespace aria
     * @description
     * The aria namespace is used to support sharing class definitions between example files
     * without causing eslint errors for undefined classes
     */
    var aria = aria || {};

    /**
     * ARIA Listbox Examples
     *
     * @function onload
     * @description Initialize the listbox examples once the page has loaded
     */

    window.addEventListener('load', function () {
        // This onload handle initializes two examples. Only initialize example if the example
        // can be found in the dom.
        if (document.getElementById('ss_imp_list')) {
            var ex1ImportantListbox = new aria.Listbox(
                document.getElementById('ss_imp_list')
            );
            var ex1UnimportantListbox = new aria.Listbox(
                document.getElementById('ss_unimp_list')
            );
            new aria.Toolbar(document.querySelector('[role="toolbar"]'));

            ex1ImportantListbox.enableMoveUpDown(
                document.getElementById('ex1-up'),
                document.getElementById('ex1-down')
            );
            ex1ImportantListbox.setupMove(
                document.getElementById('ex1-delete'),
                ex1UnimportantListbox
            );
            ex1ImportantListbox.setHandleItemChange(function (event, items) {
                var updateText = '';

                switch (event) {
                    case 'added':
                        updateText =
                            'Moved ' + items[0].innerText + ' to important features.';
                        break;
                    case 'removed':
                        updateText =
                            'Moved ' + items[0].innerText + ' to unimportant features.';
                        break;
                    case 'moved_up':
                    case 'moved_down':
                        var pos = Array.prototype.indexOf.call(
                            this.listboxNode.children,
                            items[0]
                        );
                        pos++;
                        updateText = 'Moved to position ' + pos;
                        break;
                }

                if (updateText) {
                    var ex1LiveRegion = document.getElementById('ss_live_region');
                    ex1LiveRegion.innerText = updateText;
                }
            });
            ex1UnimportantListbox.setupMove(
                document.getElementById('ex1-add'),
                ex1ImportantListbox
            );
        }

        // This onload handle initializes two examples. Only initialize example if the example
        // can be found in the dom.
        if (document.getElementById('ms_imp_list')) {
            var ex2ImportantListbox = new aria.Listbox(
                document.getElementById('ms_imp_list')
            );
            var ex2UnimportantListbox = new aria.Listbox(
                document.getElementById('ms_unimp_list')
            );

            ex2ImportantListbox.setupMove(
                document.getElementById('ex2-add'),
                ex2UnimportantListbox
            );
            ex2UnimportantListbox.setupMove(
                document.getElementById('ex2-delete'),
                ex2ImportantListbox
            );
            ex2UnimportantListbox.setHandleItemChange(function (event, items) {
                var updateText = '';
                var itemText = items.length === 1 ? '1 item' : items.length + ' items';

                switch (event) {
                    case 'added':
                        updateText = 'Added ' + itemText + ' to chosen features.';
                                 //document.getElementById('select_hidden').value = JSON.stringify(itemText) ; //
                        break;
                    case 'removed':
                        updateText = 'Removed ' + itemText + ' from chosen features.';

                        break;
                }

                if (updateText) {
                    var ex1LiveRegion = document.getElementById('ms_live_region');
                    ex1LiveRegion.innerText = updateText;
                }
            });
        }
    });

</script>
<script>
    function getValueOnSubmit() {
        // Get the value from the element with the specified ID
        const elementValue = document.getElementById("ms_unimp_list").value;
        //document.getElementById('ms_unimp_list')
        // Do something with the value (e.g., display it in an alert)
       // alert("The value is: " + elementValue);

        // Prevent the default form submission behavior
        return true;
    }
</script>

</body>

</html>

