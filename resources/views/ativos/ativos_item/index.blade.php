@extends('admin.main_master')

@section('main')

    <!-- tabs -->
    <div class="col-lg">
        <div  class="mb-4 col-md-12 mt-3" align="right">
            <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContentAtivo" data-whatever="@mdo">Importar Ativos</button>
            <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Importar Itens do Ativo</button>
        </div>

        <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="w-50 float-left card-title m-0">Painel de Ativos & Itens</h3>
                </div>

                <div class="card-body">
                    <h4 class="card-title mb-3"></h4>
                    <!-- Tabs Menu  -->
                    <ul class="nav nav-tabs" id="myIconTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="home-icon-tab" data-toggle="tab" href="#homeIcon" role="tab" aria-controls="homeIcon" aria-selected="true"><i class="nav-icon i-Add mr-1"></i>Ativo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-icon-tab" data-toggle="tab" href="#profileIcon" role="tab" aria-controls="profileIcon" aria-selected="false"><i class="nav-icon i-Arrow-Refresh mr-1"></i>Itens do Ativo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-icon-tab" data-toggle="tab" href="#listaAtivos" role="tab" aria-controls="contactIcon" aria-selected="false"><i class="nav-icon i-Add-File mr-1"></i>Lista Ativos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-icon-tab" data-toggle="tab" href="#listaItens" role="tab" aria-controls="contactIcon" aria-selected="false"><i class="nav-icon i-Address-Book-2 mr-1"></i>Lista Itens</a>
                        </li>
                    </ul>
                    <!-- Tabs Content -->
                    <div class="tab-content" id="myIconTabContent">

                        <!-- Tabs Content Ativo -->
                        <div class="tab-pane fade active show" id="homeIcon" role="tabpanel"
                             aria-labelledby="home-icon-tab">
                            <!-- Cadastro de Ativos -->
                            <form action="{{ route('ativos_store') }}" method="POST" >
                                @csrf
                                @method('POST')
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <p class="font-weight-400 mb-2">Sigla *</p>
                                    <input type="text" id="sigla" class="form-control" value="" name="sigla" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="font-weight-400 mb-2">Nome do Ativo *</p>
                                    <input type="text" id="nome" class="form-control" value="" placeholder="Nome do Ativo" name="nome" required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <p class="font-weight-400 mb-2">Natureza do Serviço *</p>
                                    <select class="form-control" id="categoria" name="categoria" required="true">
                                        <option value="">---Nenhum---</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <p class="font-weight-400 mb-2">Modelo</p>
                                    <input type="text" id="modelo" name="modelo" placeholder="Modelo" class="form-control" value="">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="font-weight-400 mb-2">N. Série</p>
                                    <input type="text" id="serie" name="serie" placeholder="N. Série" class="form-control" value="">
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
{{--                            <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContentAtivo" data-whatever="@mdo">Importar Ativos</button>--}}

                                <!-- End Cadastro Profissionais -->
                            </form>
                        </div>

                        <!-- Tabs Content Itens -->
                        <div class="tab-pane fade" id="profileIcon" role="tabpanel" aria-labelledby="profile-icon-tab">
                            <!-- Cadastro de Itens -->
                            <form action="{{ route('items.store') }}" method="POST" >
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-5">
                                        <p class="font-weight-400 mb-2">Nome do Item *</p>
                                        <input type="text" id="nome" class="form-control" value="" placeholder="Nome do Item" name="nome" required>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="font-weight-400 mb-2">Modelo</p>
                                        <input type="text" id="modelo" name="modelo" placeholder="Modelo" class="form-control" value="">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <p class="font-weight-400 mb-2">Natureza do Serviço *</p>
                                        <select class="form-control" id="categoria" name="categoria" required="true">
                                            <option value="">---Nenhum---</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <p class="font-weight-400 mb-2">Descritivo:</p><textarea rows="3"
                                                                                                 class="form-control"
                                                                                                 id="descritivo"
                                                                                                 name="descritivo"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn float-right btn-primary ml-3">Cadastrar</button>
{{--                                <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">Importar Itens do Ativo</button>--}}
                                <!-- End Cadastro Profissionais -->
                            </form>
                        </div>

                        <!-- Tabs Content Lista de Ativos -->
                        <div class="tab-pane fade active show" id="listaAtivos" role="tabpanel"
                             aria-labelledby="home-icon-tab">
                            <!-- lista de ativos -->
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <div class="card o-hidden mb-4">

                                            <div class="card-body">

                                                <div class="table-responsive">

                                                    <table id="user_table" class="table dataTable-collapse text-center">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col" style="width: 10%">AÇÕES</th>
                                                            <th scope="col" style="width: 50%">NOME</th>
                                                            <th scope="col" style="width: 40%">ITENS</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($ativos_modelos as $ativo_modelo)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('gestao.edit',$ativo_modelo->id) }}" class="text-success mr-2">
                                                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                    </a>
                                                                    <a href="{{ route('gestao.destroy',$ativo_modelo->id) }}" class="text-danger mr-2">
                                                                        <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                    </a>
                                                                </td>
                                                                <td><b>{{ $ativo_modelo->nome }}</b></td>
                                                                <td>
                                                                    N/A
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- End lista ativos -->

                        <!-- Tabs Content Lista de Itens -->
                        <div class="tab-pane fade active show" id="listaItens" role="tabpanel"
                             aria-labelledby="home-icon-tab">
                            <!-- lista de ativos -->
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <div class="card o-hidden mb-4">

                                        <div class="card-body">

                                            <div class="table-responsive">

                                                <table id="user_table" class="table dataTable-collapse text-center">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" style="width: 10%">AÇÕES</th>
                                                        <th scope="col" style="width: 50%">NOME</th>
                                                        <th scope="col" style="width: 40%">ATIVO(S)</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($itens as $item)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('gestao.edit',$item->id) }}" class="text-success mr-2">
                                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                </a>
                                                                <a href="{{ route('gestao.destroy',$item->id) }}" class="text-danger mr-2">
                                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                </a>
                                                            </td>
                                                            <td><b>{{ $item->nome }}</b></td>
                                                            <td>
                                                                N/A
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End lista itens -->

                        <!-- modal ativo -->
                        <div class="modal fade" id="verifyModalContentAtivo" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="verifyModalContent_title">Importar Ativos em Massa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('importar.csv.ativosmodelo') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="recipient-name-2" class="col-form-label">Aquivo .cvs:</label>
                                                <input type="file" class="form-control" id="recipient-name-2" name="arquivo" >
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text-1" class="col-form-label">Como Importar em Massa:</label><br>
                                                <span class=""><a href="#">Baixe Aqui</a> o arquivo CSV de Ativos.</span>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Importar</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal importar -->
                        <!-- modal item -->
                        <div class="modal fade" id="verifyModalContent" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="verifyModalContent_title">Importar Itens em Massa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('importar.csv.itens') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="recipient-name-2" class="col-form-label">Aquivo .cvs:</label>
                                                <input type="file" class="form-control" id="recipient-name-2" name="arquivo">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text-1" class="col-form-label">Como Importar em Massa:</label><br>
                                                <span class=""><a href="#">Baixe Aqui</a> o arquivo CSV de Itens.</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Importar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal importar -->
                    </div>
                </div>

            </div>

    </div>

    <!-- End tabs -->
@endsection
