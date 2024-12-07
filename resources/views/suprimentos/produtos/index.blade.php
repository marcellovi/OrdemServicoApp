@extends('admin.main_master')

@section('main')

    <div class="mb-4 col-md-12 mt-3" align="right">
        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#verifyModalContentProduto"
                data-whatever="@mdo">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <span class="ul-btn__text">&nbsp; Cadastrar Novo Produto</span>
        </button>
    </div>

    <!-- Gestao Cadastro -->
    <div class="col-md">
        <div class="card o-hidden mb-4">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Gestão de Produtos</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table id="user_table" class="table dataTable-collapse text-center">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10%">CODIGO</th>
                            <th scope="col" style="width: 60%">NOME</th>
                            <th scope="col" style="width: 10%">QT. MIN</th>
                            <th scope="col" style="width: 10%">QT. REPOSIÇÃO</th>
                            <th scope="col" style="width: 10%">AÇÕES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($produtos as $produto)
                                <td style="width: 10%">
                                    <b>{{ $produto->codprod }}</b></td>
                                <td style="width: 60%"><b>{{ $produto->nome }}</b></td>
                                <td style="width: 10%">
                                    {{ (empty($produto->qt_minima)) ? $produto->qt_minima : 'Não Informado' }}
                                </td>
                                <td style="width: 10%">
                                    {{ (empty($produto->qt_reposicao)) ? $produto->qt_reposicao: 'Não Informado' }}
                                </td>
{{--                                <td>--}}
{{--                                    {{ (isset($data['status']->where('id',$usuario->status_id)->first()->nome)) ?--}}
{{--                                        $data['status']->where('id',$usuario->status_id)->first()->nome--}}
{{--                                        : 'Nenhum'--}}
{{--                                    }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @isset($data['roles']->where('id',$usuario->role_id)->first()->name)--}}
{{--                                        <h5><span--}}
{{--                                                class="badge badge-pill badge-outline-dark">{{ $data['roles']->where('id',$usuario->role_id)->first()->name }}</span></h5>--}}
{{--                                    @else--}}
{{--                                        <span class="badge badge-pill badge-dark">{{ 'Nenhum' }}</span>--}}
{{--                                    @endisset--}}
{{--                                    --}}{{-- (isset() ? '<span class="badge badge-success">'.$data['roles']->where('id',$usuario->role_id)->first()->name.'</span>' : 'Nenhum' --}}
{{--                                </td>--}}
                                <td class="btn-group" role="group" style="width: 10%">
                                    <a href="{{ route('produto.edit',$produto->id) }}"
                                       class="btn btn-outline-success m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('produto.destroy',$produto->id) }}" class="btn btn-outline-danger btn-icon m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </a>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- modal cadastro produtos -->
    <div class="modal fade" id="verifyModalContentProduto" tabindex="-1" role="dialog"
         aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">Cadastrar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ route('produto.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Cod. Produto</label>
                                <input type="text" id="codprod" name="codprod" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Qt. Minimo</label>
                                <input type="text" class="form-control" id="qt_minima" name="qt_minima">
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Qt. Reposição</label>
                                <input type="text" class="form-control" id="qt_reposicao" name="qt_reposicao">
                            </div>
                            <div class="col-md-12">
                                <label for="recipient-name-2" class="col-form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome">
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Categoria</label>
                                <select name="categoria_id" id="categoria_id" class="form-control" required>--}}
                                    <option value="" selected>---Selecione---</option>
                                    <option value="1" >Cat1</option>
                                    {{--                                    @foreach($data['equipes'] as $equipe)--}}
                                    {{--                                        <option value="{{ $equipe->id }}">{{ $equipe->nome }}</option>--}}
                                    {{--                                    @endforeach--}}
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Fabricante</label>
                                <select name="fabricante_id" id="fabricante_id" class="form-control" required>
                                    <option value="" selected>---Selecione---</option>
                                    <option value="1" >Fab1</option>
{{--                                    @foreach($data['status'] as $status)--}}
{{--                                        <option--}}
{{--                                            value="{{ $status->id }}" {{ ($status->nome == 'ativo') ? 'selected' : '' }}>{{ $status->nome }}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Unid. Medida</label>
                                <select name="unid_medida_id" id="unid_medida_id" class="form-control">
                                    <option value="" selected>---Nenhum---</option>
                                    <option value="1" >Metro</option>
                                    {{--                                    @foreach($data['cargos'] as $cargo)--}}
                                    {{--                                        <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>--}}
                                    {{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection