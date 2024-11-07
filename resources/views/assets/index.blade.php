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

    <!-- Bootstrap Taginput
    <link rel="stylesheet" href="https://htmlstream.com/preview/front-v2.9.0/assets/vendor/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
    -->
    <link rel="stylesheet" href="assets/styles/vendor/taginputs/bootstrap-taginput.css">

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

            <!-- Cadastro de Ativos -->
            <div class="col-lg-6 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Cadastro de Ativos</h3>
                    </div>
                    <div class="card-body">
                        <form action="ativos/store" method="POST">
                            @csrf
                        <div class="row" x-data="{ tags: '' }">
                            <div class="mb-3 col-md-12">
                                <p class="font-weight-400 mb-2">Tags</p>
                                <input type="text" id="tags" class="form-control"
                                       value="" name="tags" x-model.fill="tags">
                                <!--                FS01-BL03-AND02-SL03-AC01                    <input type="text" id="tags"  class="form-control" data-role="tagsinput"  value="TAG-0001">-->
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="font-weight-400 mb-2">Nome do Ativo *</p>
                                <select id="nome_ativo" name="nome_ativo" class="form-control" required="true">
                                    <option value="" selected >---Selecione---</option>
                                    @foreach($assets['artefatos'] as $artefato)
                                    <option value="{{ strtoupper($artefato->sigla) }}" >{{ strtoupper($artefato->sigla).'-'.strtoupper($artefato->nome) }}</option>

{{--                                    <option value="AC01" >AC01</option>--}}
{{--                                    <option value="AB01">AB01</option>--}}
{{--                                    <option value="CD02">CD02</option>--}}
{{--                                    <option value="SP01">SP01</option>--}}
                                    @endforeach
                                </select>
                                <!--                                    <input type="text" placeholder="Nome" class="form-control">-->
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="font-weight-400 mb-2">Categoria *</p>
                                <select id="categoria" name="categoria" class="form-control" required="true">
                                    <option value="">---Selecione---</option>
                                    @foreach($assets['categorias'] as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <p class="font-weight-400 mb-2">Modelo</p><input type="text" id="modelo" name="modelo"  placeholder="Modelo"
                                                                                 class="form-control" value="">
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="font-weight-400 mb-2">N. Série</p><input type="text" id="serie" name="serie"  placeholder="N. Série"
                                                                                   class="form-control"
                                                                                   value="">
                            </div>
                            <!-- fase-bloco-andar-sala_area -->
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Fase *</p>
                                <select class="form-control" id="fase" name="fase" required="true" x-ref="fase" x-on:change="tags = $el.options[$el.selectedIndex].text">
                                    <option value="">---Nenhum---</option>
                                    @foreach($assets['fases'] as $fase)
                                        <option value="{{ $fase->id }}">{{ $fase->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Loc. Bloco *</p>
                                <select class="form-control" id="bloco" name="bloco" required="true" x-ref="bloco" x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                    <option value="">---Nenhum---</option>
                                    @foreach($assets['blocos'] as $bloco)
                                        <option value="{{ $bloco->id }}">{{ $bloco->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Loc. Andar *</p>
                                <select class="form-control" id="andar" name="andar"  required="true" x-ref="andar" x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                    <option value="">---Nenhum---</option>
                                    @foreach($assets['andares'] as $andar)
                                        <option value="{{ $andar->id }}">{{ $andar->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Loc. Sala/Área *</p>
                                <select class="form-control" id="sala_area" name="sala_area" required="true" x-ref="sala_area" x-on:change="tags = $refs.fase.options[$refs.fase.options.selectedIndex].text  + '-' + $refs.bloco.options[$refs.bloco.options.selectedIndex].text  + '-' + $refs.andar.options[$refs.andar.options.selectedIndex].text  + '-' + $el.options[$el.selectedIndex].text">
                                    <option value="">---Nenhum---</option>
                                    @foreach($assets['sala_areas'] as $sala_area)
                                        <option value="{{ $sala_area->id }}">{{ $sala_area->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                                <p class="font-weight-400 mb-2">Foto do Ativo</p>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                               aria-describedby="inputGroupFileAddon01" accept="image/*;capture=camera">
                                        <label class="custom-file-label" for="inputGroupFile01">Selecione Imagem do
                                            Ativo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <p class="font-weight-400 mb-2" id="descritivo" name="descritivo">Descritivo:</p><textarea rows="3" class="form-control"></textarea>
                            </div>

                        </div>
                        <button type="submit" class="btn float-right btn-primary">Cadastrar</button>
                    </form>
                    </div>
                </div>
            </div>

            <!-- End Cadastro Profissionais -->


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
                                    <th scope="col">STATUS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ativos as $ativo)
                                <tr>
                                    <td>
                                        <a href="#" class="text-success mr-2">
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
                                        {{ $ativo->created_at }}
                                    </td>
                                    <td>
                                    @switch($ativo->status)

                                        @case('Em Analise')
                                                @php $status_color = 'warning'; @endphp
                                                @break
                                        @case('Aberta')
                                            @php $status_color = 'success'; @endphp
                                            @break
                                        @case('Em Andamento')
                                            @php $status_color = 'waiting'; @endphp
                                            @break
                                        @case('Em Espera')
                                            @php $status_color = 'danger'; @endphp
                                            @break
                                        @case('Fechada')
                                            @php $status_color = 'outline-dark'; @endphp
                                            @break
                                        @default
                                            @php $status_color = 'outline-danger'; @endphp
                                    @endswitch
                                        <span class="badge badge-{{ $status_color }}">{{ $ativo->status }}</span></td>
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
    window.setTimeout("document.getElementById('msg_alert').style.display='none';", 3000);
</script>

</body>

</html>

