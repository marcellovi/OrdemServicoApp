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

</head>

<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large clearfix">

    <!-- Top Menu and Left Side Menu -->
    @include ('frontend.body.sidemenu');
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


        <!--            <div class="row">-->
        <!--                <-- ICON BG -->
        <!--                <div class="col-lg-3 col-md-6 col-sm-6">-->
        <!--                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">-->
        <!--                        <div class="card-body text-center">-->
        <!--                            <i class="i-File-Clipboard-File--Text"></i>-->
        <!--                            <div class="content">-->
        <!--                                <p class="text-muted mt-2 mb-0">ATIVOS</p>-->
        <!--                                <p class="text-primary text-24 line-height-1 mb-2">200</p>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!---->
        <!--                <div class="col-lg-3 col-md-6 col-sm-6">-->
        <!--                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">-->
        <!--                        <div class="card-body text-center">-->
        <!--                            <i class="i-Financial"></i>-->
        <!--                            <div class="content">-->
        <!--                                <p class="text-muted mt-2 mb-0">INATIVOS</p>-->
        <!--                                <p class="text-primary text-24 line-height-1 mb-2">10</p>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!---->
        <!--                <div class="col-lg-3 col-md-6 col-sm-6">-->
        <!--                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">-->
        <!--                        <div class="card-body text-center">-->
        <!--                            <i class="i-Checkout-Basket"></i>-->
        <!--                            <div class="content">-->
        <!--                                <p class="text-muted mt-2 mb-0">FERIAS</p>-->
        <!--                                <p class="text-primary text-24 line-height-1 mb-2">80</p>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!---->
        <!--                <div class="col-lg-3 col-md-6 col-sm-6">-->
        <!--                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">-->
        <!--                        <div class="card-body text-center">-->
        <!--                            <i class="i-Money-2"></i>-->
        <!--                            <div class="content">-->
        <!--                                <p class="text-muted mt-2 mb-0">TOTAL</p>-->
        <!--                                <p class="text-primary text-24 line-height-1 mb-2">220</p>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!---->
        <!--            </div>-->

        <div class="row">

            <!-- Cadastro de Ativos -->
            <div class="col-lg-6 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Cadastro de Ativos</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <p class="font-weight-400 mb-2">Tags</p>
                                <input type="text" id="tags" class="form-control" disabled
                                       value="FS01-BL03-AND02-SL03-AC01">
                                <!--                                    <input type="text" id="tags"  class="form-control" data-role="tagsinput"  value="TAG-0001">-->
                            </div>

                            <div class="mb-3 col-md-6">
                                <p class="font-weight-400 mb-2">Nome do Ativo *</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="">---Selecione---</option>
                                    <option value="Mobiliario" selected>AC01</option>
                                    <option value="Eq.Eletronico">AB01</option>
                                    <option value="Eq.Eletronico">CD02</option>
                                    <option value="Eq.Eletronico">SP01</option>
                                </select>
                                <!--                                    <input type="text" placeholder="Nome" class="form-control">-->
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="font-weight-400 mb-2">Categoria</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="">---Selecione---</option>
                                    <option value="Mobiliario" selected>Refrigeração</option>
                                    <option value="Eq.Eletronico">Eq. Eletronico</option>
                                    <option value="Eq.Eletronico">Mobiliário</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <p class="font-weight-400 mb-2">Modelo</p><input type="text" placeholder="Modelo"
                                                                                 class="form-control" value="Consul">
                            </div>
                            <div class="mb-3 col-md-6">
                                <p class="font-weight-400 mb-2">N. Série</p><input type="text" placeholder="N. Série"
                                                                                   class="form-control"
                                                                                   value="NS896543-88776">
                            </div>

                            <!--                                <div class="form-group">-->
                            <!--                                    <div data-no-duplicate="true" data-pre-tags-separator="\n" data-no-duplicate-text="Duplicate tags" data-type-zone-class="type-zone" data-tag-box-class="tagging" data-edit-on-delete="false" class="tagBox tagging editable"><div class="tag"><span>#</span> preexisting-tag<input type="hidden" name="tag[]" value="preexisting-tag"><a role="button" class="tag-i">×</a></div><div class="tag"><span>#</span> vbvbcvbcv<input type="hidden" name="tag[]" value="vbvbcvbcv"><a role="button" class="tag-i">×</a></div><div class="tag"><span>#</span> gfgdfgdf<input type="hidden" name="tag[]" value="gfgdfgdf"><a role="button" class="tag-i">×</a></div><input class="type-zone" contenteditable="true"></div>-->
                            <!--                                    <p class="text-muted">Enter key add a new tag by default, set it-->
                            <!--                                        <code>no-enter:true</code> to disable that.</p>-->
                            <!--                                </div>-->


                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Loc. Bloco *</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum">---Nenhum---</option>
                                    <option value="Tipo 1">BL01</option>
                                    <option value="Tipo 2">BL02</option>
                                    <option value="Tipo 2" selected>BL03</option>
                                    <option value="Tipo 2">BL04</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Loc. Andar *</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum">---Nenhum---</option>
                                    <option value="Tipo 1">AND01</option>
                                    <option value="Tipo 2" selected>AND02</option>
                                    <option value="Tipo 2">AND03</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Loc. Sala/Área *</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum">---Nenhum---</option>
                                    <option value="Tipo 1">SL01</option>
                                    <option value="Tipo 2">SL02</option>
                                    <option value="Tipo 2" selected>SL03</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Fase *</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum">---Nenhum---</option>
                                    <option value="Tipo 1" selected>FS01</option>
                                    <option value="Tipo 2">FS02</option>
                                    <option value="Tipo 2">FS03</option>
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
                                <p class="font-weight-400 mb-2">Descritivo:</p><textarea rows="3" class="form-control">Ar Condicionado comprado para substituir Ar modelo XYZ</textarea>
                            </div>

                        </div>
                        <button type="button" class="btn float-right btn-primary">Cadastrar</button>
                        <!-- <div class="ul-widget-app__browser-list scroll" id="mydiv">

                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-warning rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Elétrica</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Refrigeração</span>
                                <span class="badge badge-close">FECHADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white cyan-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Jardinagem</span>
                                <span class="badge badge-info">PROGRAMADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white teal-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Limpeza</span>
                                <span class="badge badge-danger">CANCELADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white purple-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Civil</span>
                                <span class="badge badge-warning">EM ESPERA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-danger rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Eng. Clinica</span>
                                <span class="badge badge-waiting">AGUARDANDO MATERIAL</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Jardinagem</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Refrigeração</span>
                                <span class="badge badge-close">FECHADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Elétrica</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white cyan-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Jardinagem</span>
                                <span class="badge badge-info">PROGRAMADA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-danger rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Eng. Clinica</span>
                                <span class="badge badge-waiting">AGUARDANDO MATERIAL</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-warning rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Elétrica</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white bg-danger rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Eng. Clinica</span>
                                <span class="badge badge-waiting">AGUARDANDO MATERIAL</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Jardinagem</span>
                                <span class="badge badge-success">ABERTA</span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Gears  text-white teal-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">Limpeza</span>
                                <span class="badge badge-danger">CANCELADA</span>
                            </div>
                        </div> -->


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
                                <tr>
                                    <td>
                                        <a href="#" class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>
                                        <a href="#" class="text-danger mr-2">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </a>
                                    </td>
                                    <td>FS01-BL03-AND02-SL03-AC01</td>
                                    <td>
                                        Emerson
                                    </td>

                                    <td>Eq. Eletronico</td>
                                    <td>
                                        24/09/2024
                                    </td>
                                    <td><span class="badge badge-success">Ativo</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>
                                        <a href="#" class="text-danger mr-2">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </a>
                                    </td>
                                    <td>FS04-BL02-AND02-SL01-AC01</td>
                                    <td>
                                        João
                                    </td>

                                    <td>Mobiliario</td>
                                    <td>
                                        24/09/2024
                                    </td>
                                    <td><span class="badge badge-primary">Ferias</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>
                                        <a href="#" class="text-danger mr-2">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </a>
                                    </td>
                                    <td>FS00-BL03-AND02-SL02-AC03</td>
                                    <td>
                                        Marcello
                                    </td>

                                    <td>Refrigeração</td>
                                    <td>
                                        01/07/2000
                                    </td>
                                    <td><span class="badge badge-success">Ativo</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>
                                        <a href="#" class="text-danger mr-2">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </a>
                                    </td>
                                    <td>FS05-BL07-AND01-SL01-AC01</td>
                                    <td>
                                        Ricardo
                                    </td>

                                    <td>Eq. Eletronico</td>
                                    <td>
                                        24/01/2014
                                    </td>
                                    <td><span class="badge badge-success">Ativo</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="text-success mr-2">
                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                        </a>
                                        <a href="#" class="text-danger mr-2">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </a>
                                    </td>
                                    <td>FS01-BL02-AND02-SL03-AC02</td>
                                    <td>
                                        Maria
                                    </td>

                                    <td>Refrigeração</td>
                                    <td>
                                        05/09/2024
                                    </td>
                                    <td><span class="badge badge-danger">Inativo</span></td>
                                </tr>

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

</body>

</html>

