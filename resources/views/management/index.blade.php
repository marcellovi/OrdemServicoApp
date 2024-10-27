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

    <!-- Quill Rich Text Editor -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet"/>

    <!-- Test Widget-->
    <link rel="stylesheet" href="https://maposdemo.sysgo.com.br/assets/css/matrix-style.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="assets/styles/vendor/datepicker/datepicker.material.css">

    <style>
        div.scroll {
            max-height: 500px;
            overflow: scroll;
            overflow-x: auto;
        }
    </style>
</head>

<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large clearfix">

    <!-- Top Menu and Left Side Menu -->

    <!--=============== Left side End ================-->
    @include ('admin.body.sidemenu');
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

        <!--
        <div class="row">
             ICON BG
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-File-Clipboard-File--Text"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">ATIVOS</p>
                            <p class="text-primary text-24 line-height-1 mb-2">200</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Financial"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">INATIVOS</p>
                            <p class="text-primary text-24 line-height-1 mb-2">10</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Checkout-Basket"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">FERIAS</p>
                            <p class="text-primary text-24 line-height-1 mb-2">80</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Money-2"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">TOTAL</p>
                            <p class="text-primary text-24 line-height-1 mb-2">220</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>  -->

        <div class="row">

            <!-- OS Programadas -->
            <div class="col-lg-6 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">OS Programadas</h3>
                    </div>
                    <div class="card-body">
                        <div class="ul-widget-app__browser-list scroll" id="mydiv">

                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-3  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0096 - TAG01AR01 - SEOR01 - PRDO2 - TROCA DE TERMOSTATO -
                                    EQUIPE REFRIGERAÇÃO - PROGRAMADA - DT.ABERTURA 30/09/2024 - PRIORIDADE ALTA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-2  text-white orange-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0032 - TAG01AR02 - SEOR01 - PRDO2 - TROCA DE BUBUNA -
                                    EQUIPE REFRIGERAÇÃO - EMERGENCIAL - DT.ABERTURA 30/09/2024 - PRIORIDADE MEDIA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-2  text-white orange-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0032 - TAG01AR02 - SEOR01 - PRDO2 - TROCA DE BUBUNA -
                                    EQUIPE REFRIGERAÇÃO - EMERGENCIAL - DT.ABERTURA 30/09/2024 - PRIORIDADE MEDIA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up  text-white blue-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0067 - TAG01AR03 - SEOR01 - PRDO3 - MANUTENÇÃO SELETOR -
                                    EQUIPE REFRIGERAÇÃO - CORRETIVA - DT.ABERTURA 30/09/2024 - PRIORIDADE BAIXA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-3  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0096 - TAG01AR01 - SEOR01 - PRDO2 - TROCA DE TERMOSTATO -
                                    EQUIPE REFRIGERAÇÃO - PROGRAMADA - DT.ABERTURA 30/09/2024 - PRIORIDADE ALTA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-3  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0096 - TAG01AR01 - SEOR01 - PRDO2 - TROCA DE TERMOSTATO -
                                    EQUIPE REFRIGERAÇÃO - PROGRAMADA - DT.ABERTURA 30/09/2024 - PRIORIDADE ALTA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-3  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0096 - TAG01AR01 - SEOR01 - PRDO2 - TROCA DE TERMOSTATO -
                                    EQUIPE REFRIGERAÇÃO - PROGRAMADA - DT.ABERTURA 30/09/2024 - PRIORIDADE ALTA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-2  text-white orange-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0032 - TAG01AR02 - SEOR01 - PRDO2 - TROCA DE BUBUNA -
                                    EQUIPE REFRIGERAÇÃO - EMERGENCIAL - DT.ABERTURA 30/09/2024 - PRIORIDADE MEDIA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-2  text-white orange-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0032 - TAG01AR02 - SEOR01 - PRDO2 - TROCA DE BUBUNA -
                                    EQUIPE REFRIGERAÇÃO - EMERGENCIAL - DT.ABERTURA 30/09/2024 - PRIORIDADE MEDIA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up  text-white blue-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0067 - TAG01AR03 - SEOR01 - PRDO3 - MANUTENÇÃO SELETOR -
                                    EQUIPE REFRIGERAÇÃO - CORRETIVA - DT.ABERTURA 30/09/2024 - PRIORIDADE BAIXA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-3  text-white green-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0096 - TAG01AR01 - SEOR01 - PRDO2 - TROCA DE TERMOSTATO -
                                    EQUIPE REFRIGERAÇÃO - PROGRAMADA - DT.ABERTURA 30/09/2024 - PRIORIDADE ALTA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-2  text-white orange-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0032 - TAG01AR02 - SEOR01 - PRDO2 - TROCA DE BUBUNA -
                                    EQUIPE REFRIGERAÇÃO - EMERGENCIAL - DT.ABERTURA 30/09/2024 - PRIORIDADE MEDIA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up-2  text-white orange-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0032 - TAG01AR02 - SEOR01 - PRDO2 - TROCA DE BUBUNA -
                                    EQUIPE REFRIGERAÇÃO - EMERGENCIAL - DT.ABERTURA 30/09/2024 - PRIORIDADE MEDIA </span>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Arrow-Up  text-white blue-500 rounded-circle p-2  mr-3"></i>
                                <span class="text-15">OS0067 - TAG01AR03 - SEOR01 - PRDO3 - MANUTENÇÃO SELETOR -
                                    EQUIPE REFRIGERAÇÃO - CORRETIVA - DT.ABERTURA 30/09/2024 - PRIORIDADE BAIXA </span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- end of col-->

            <!-- Cadastro de OS -->
            <div class="col-lg-6 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="w-50 float-left card-title m-0">Cadastro de OS</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-2 col-md-2">
                                <p class="font-weight-400 mb-2">Nr.OS</p><input type="text" placeholder="ER001"
                                                                                class="form-control" disabled>
                            </div>
                            <div class="mb-2 col-md-5">
                                <p class="font-weight-400 mb-2">Tag.</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="" selected>---Selecione---</option>
                                    <option value="Masculino">Alta</option>
                                    <option value="Feminino">Media</option>
                                    <option value="Feminino">Baixa</option>
                                </select>
                            </div>
                            <div class="mb-2 col-md-5">
                                <p class="font-weight-400 mb-2">Prioridade</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Masculino">Alta</option>
                                    <option value="Feminino">Media</option>
                                    <option value="Feminino">Baixa</option>
                                </select>

                            </div>

                            <div class="mb-3  col-md-4">
                                <p class="font-weight-400 mb-2">Dt. Abertura</p><input id="dtabertura" type="text"
                                                                                       placeholder="__/__/__"
                                                                                       class="form-control">
                            </div>
                            <div class="mb-3 col-md-4">
                                <p class="font-weight-400 mb-2">Dt. Programada</p><input id="dtprogramada" type="text"
                                                                                         placeholder="__/__/__"
                                                                                         class="form-control">
                            </div>
                            <div class="mb-3 col-md-4">
                                <p class="font-weight-400 mb-2">Tp. Manutenção</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum" selected>---Nenhum---</option>
                                    <option value="Tipo 1">Tipo 1</option>
                                    <option value="Tipo 2">Tipo 2</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Naturea do Serviço</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum" selected>---Nenhum---</option>
                                    <option value="Tipo 1">Tipo 1</option>
                                    <option value="Tipo 2">Tipo 2</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Eq. Responsável</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum" selected>---Nenhum---</option>
                                    <option value="Tipo 1">Tipo 1</option>
                                    <option value="Tipo 2">Tipo 2</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Responsavel</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum" selected>---Nenhum---</option>
                                    <option value="Tipo 1">Tipo 1</option>
                                    <option value="Tipo 2">Tipo 2</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <p class="font-weight-400 mb-2">Executor</p>
                                <select id="theme_selector" class="form-control">
                                    <option value="Nenhum" selected>---Nenhum---</option>
                                    <option value="Tipo 1">Tipo 1</option>
                                    <option value="Tipo 2">Tipo 2</option>
                                </select>
                            </div>
                        </div>


                        <p class="font-weight-400 mb-2">Descritivo</p>
                        <div id="editor"></div>
                        <br>

                        <p class="font-weight-400 mb-2">Descritivo Executado</p>
                        <div id="desc_executado"></div>

                        <br>
                        <button type="button" class="btn float-right btn-primary ml-3"
                        ">EDITAR</button>
                        <button type="button" class="btn float-right btn-primary ml-3"
                        ">FECHAR</button>&nbsp&nbsp&nbsp
                        <button type="button" class="btn float-right btn-primary ml-3"
                        ">EXCLUIR</button>
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


            <!-- Test Widget
            <div class="col-lg-4">
                <div class="widget-box-new widbox-blak" style="height:100%">
                    <div><h5 class="cardHeader">Estatísticas do Sistema</h5></div>
                    <div class="new-bottons"><a href="https://maposdemo.sysgo.com.br/index.php/clientes/adicionar"
                                                class="card tip-top" title=""
                                                data-original-title="Add Clientes e Fornecedores">
                            <div><i class="bx bxs-group iconBx"></i></div>
                            <div>
                                <div class="cardName2">2</div>
                                <div class="cardName">Clientes</div>
                            </div>
                        </a> <a href="https://maposdemo.sysgo.com.br/index.php/produtos/adicionar"
                                class="card tip-top" title="" data-original-title="Adicionar Produtos">
                            <div><i class="bx bxs-package iconBx2"></i></div>
                            <div>
                                <div class="cardName2">5</div>
                                <div class="cardName">Produtos</div>
                            </div>
                        </a> <a href="https://maposdemo.sysgo.com.br/index.php/servicos/adicionar"
                                class="card tip-top" title="" data-original-title="Adicionar serviços">
                            <div><i class="bx bxs-stopwatch iconBx3"></i></div>
                            <div>
                                <div class="cardName2">5</div>
                                <div class="cardName">Serviços</div>
                            </div>
                        </a> <a href="https://maposdemo.sysgo.com.br/index.php/os/adicionar" class="card tip-top"
                                title="" data-original-title="Adicionar OS">
                            <div><i class="bx bxs-spreadsheet iconBx4"></i></div>
                            <div>
                                <div class="cardName2">10</div>
                                <div class="cardName">Ordens</div>
                            </div>
                        </a> <a href="https://maposdemo.sysgo.com.br/index.php/garantias" class="card tip-top"
                                title="" data-original-title="Adicionar garantia">
                            <div><i class="bx bxs-receipt iconBx6"></i></div>
                            <div>
                                <div class="cardName2">4</div>
                                <div class="cardName">Garantias</div>
                            </div>
                        </a> <a href="https://maposdemo.sysgo.com.br/index.php/vendas/adicionar"
                                class="card tip-top" title="" data-original-title="Adicionar Vendas">
                            <div><i class="bx bxs-cart-alt iconBx5"></i></div>
                            <div>
                                <div class="cardName2">2</div>
                                <div class="cardName">Vendas</div>
                            </div>
                        </a>

                        <a href="https://maposdemo.sysgo.com.br/index.php/financeiro/lancamentos"
                           class="card tip-top" title="" data-original-title="Adicionar receita">
                            <div><i class="bx bxs-up-arrow-circle iconBx7"></i></div>
                            <div>
                                <div class="cardName1 cardName2">R$ 156,99</div>
                                <div class="cardName">Receita do dia</div>
                            </div>
                        </a> <a href="https://maposdemo.sysgo.com.br/index.php/financeiro/lancamentos"
                                class="card tip-top" title="" data-original-title="Adiciona despesa">
                            <div><i class="bx bxs-down-arrow-circle iconBx8"></i></div>
                            <div>
                                <div class="cardName1 cardName2">R$ 0,00</div>
                                <div class="cardName">Despesa do dia</div>
                            </div>
                        </a></div>
                </div>
            </div>
            <!-- End Test -->


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

<!-- Date Picker-->
<script src="assets/js/datepicker/datepicker.js"></script>
<script>
    var dtabertura = new Datepicker('#dtabertura');
    var dtprogramada = new Datepicker('#dtprogramada');
</script>


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
</body>

</html>

