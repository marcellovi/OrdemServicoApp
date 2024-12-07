@extends('admin.main_master')

@section('main')

    <!-- tabs -->
    <div class="col-lg">
        <div  class="mb-4 col-md-12 mt-3" align="right">
            <button class="btn btn-primary m-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                    <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"/>
                </svg>
                <span class="ul-btn__text">&nbsp; <a href="{{ route('link-ativos-itens') }}" style="text-decoration:none;color: white"> Vincular Itens</a></span>
            </button>
            <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentAtivo" data-whatever="@mdo">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
                    <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/>
                </svg>
                <span class="ul-btn__text">&nbsp; Importar Ativos</span>
            </button>
            <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContent" data-whatever="@mdo">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
                    <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/>
                </svg>
                <span class="ul-btn__text">&nbsp; Importar Itens do Ativo</span>
            </button>

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
                            <form action="{{ route('ativos_store') }}" method="POST" enctype="multipart/form-data">
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
                                            <input type="file" class="custom-file-input" id="files_ativo" name="files_ativo[]"
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
                            <button type="submit" class="btn float-right btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                </svg>&nbsp;
                                Cadastrar</button>
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
                        <div class="tab-pane fade" id="listaAtivos" role="tabpanel"
                             aria-labelledby="home-icon-tab">
                            <!-- lista de ativos -->
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <div class="card o-hidden mb-4">

                                            <div class="card-body">

                                                <div class="table-responsive">
                                                    <table id="sales_table" class="table dataTable-collapse text-center">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col" style="width: 10%">ID</th>
                                                            <th scope="col" style="width: 10%">SIGLA</th>
                                                            <th scope="col" style="width: 25%">NOME</th>
                                                            <th scope="col" style="width: 20%">MODELO</th>
                                                            <th scope="col" style="width: 20%">SERIE</th>
                                                            <th scope="col" style="width: 15%">AÇÕES</th>
{{--                                                            <th scope="col" style="width: 40%">ITENS</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($ativos_modelos as $ativo_modelo)
                                                            <tr >
                                                                <td style="width: 10%"><b>{{ $ativo_modelo->id }}</b></td>
                                                                <td style="width: 10%"><b>{{ $ativo_modelo->sigla }}</b></td>
                                                                <td style="width: 25%"><b>{{ $ativo_modelo->nome }}</b></td>
                                                                <td style="width: 20%"><b>{{ $ativo_modelo->modelo }}</b></td>
                                                                <td style="width: 20%"><b>{{ $ativo_modelo->serie }}</b></td>
                                                                <td style="width: 15%">
                                                                    <a href="{{ route('ativo.modelo.edit',$ativo_modelo->id) }}"
                                                                       class="btn btn-outline-success m-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                            <path fill-rule="evenodd"
                                                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                                        </svg>
                                                                    </a>
                                                                    <a href="{{ route('ativo.modelo.destroy',$ativo_modelo->id) }}" class="btn btn-outline-danger btn-icon m-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                             fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                                            <path
                                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                                        </svg>
                                                                    </a>

                                                                    <a href="{{ route('ativo.modelo.details',$ativo_modelo->id) }}" class="btn btn-outline-info btn-icon m-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
                                                                            <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2m0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1M3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/>
                                                                        </svg>
                                                                    </a>

                                                                </td>
{{--                                                                <td>--}}
{{--                                                                    N/A--}}
{{--                                                                </td>--}}
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
                        <div class="tab-pane fade" id="listaItens" role="tabpanel"
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
                                                        <th scope="col" style="width: 10%">ID</th>
                                                        <th scope="col" style="width: 40%">NOME</th>
                                                        <th scope="col" style="width: 40%">MODELO</th>
                                                        <th scope="col" style="width: 10%">AÇÕES</th>
{{--                                                        <th scope="col" style="width: 40%">ATIVO(S)</th>--}}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($itens as $item)
                                                        <tr>
                                                            <td style="width: 10%"><b>{{ $item->id }}</b></td>
                                                            <td style="width: 40%"><b>{{ $item->nome }}</b></td>
                                                            <td style="width: 40%"><b>{{ $item->modelo }}</b></td>
                                                            <td style="width: 10%">

                                                                <a href="{{ route('ativo.item.edit',$item->id) }}"
                                                                   class="btn btn-outline-success m-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                         fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                        <path fill-rule="evenodd"
                                                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                                    </svg>
                                                                </a>
                                                                <a href="{{ route('ativo.item.destroy',$item->id) }}" class="btn btn-outline-danger btn-icon m-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                         fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                                        <path
                                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                                    </svg>
                                                                </a>
                                                            </td>

{{--                                                            <td>--}}
{{--                                                                N/A--}}
{{--                                                            </td>--}}
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
                                                <span class="">
                                                        Arquivo .CSV para Importação de Ativos
                                                    <a href="{{ asset('assets/downloads/importar_modelo_ativo.csv') }}" download>
                                                         Baixe Aqui  <i class="i-Download"></i></a> </span>
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
                                                <span class="">
                                                        Arquivo .CSV para Importação de Itens do Ativo
                                                    <a href="{{ asset('assets/downloads/importar_modelo_item.csv') }}" download>
                                                         Baixe Aqui  <i class="i-Download"></i></a> </span>
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
