@extends('admin.main_master')

@section('main')

    <div class="mb-4 col-md-12 mt-3" align="right">
        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContentUsuario"
                data-whatever="@mdo">Cadastrar Usuário
        </button>
        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContentCargo"
                data-whatever="@mdo">Criar Novo Cargo
        </button>
    </div>

    <!-- Gestao Cadastro -->
    <div class="col-md">
        <div class="card o-hidden mb-4">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Gestão de Profissionais</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table id="user_table" class="table dataTable-collapse text-center">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 15%">MATRICULA</th>
                            <th scope="col" style="width: 25%">NOME</th>
                            <th scope="col" style="width: 20%">CARGO</th>
                            <th scope="col" style="width: 20%">EQUIPE</th>
                            <th scope="col" style="width: 12%">STATUS</th>
                            <th scope="col" style="width: 12%">PERMISSÃO</th>
                            <th scope="col" style="width: 8%">AÇÕES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($usuarios as $usuario)
                                <td data-toggle="tooltip" data-placement="top" title="{{ $usuario->email }}"
                                    data-original-title="{{ $usuario->email }}" style="cursor: pointer;">
                                    <b>{{ $usuario->matricula }}</b></td>
                                <td><b>{{ $usuario->name }}</b></td>
                                <td>
                                    {{ (isset($data['cargos']->where('id',$usuario->cargo_id)->first()->nome)) ? $data['cargos']->where('id',$usuario->cargo_id)->first()->nome : 'Nenhum' }}
                                </td>
                                <td>
                                    {{ (isset($data['equipes']->where('id',$usuario->equipe_id)->first()->nome)) ? $data['equipes']->where('id',$usuario->equipe_id)->first()->nome : 'Nenhum' }}
                                </td>
                                <td>
                                    {{ (isset($data['status']->where('id',$usuario->status_id)->first()->nome)) ?
                                        $data['status']->where('id',$usuario->status_id)->first()->nome
                                        : 'Nenhum'
                                    }}
                                </td>
                                <td>
                                    @isset($data['roles']->where('id',$usuario->role_id)->first()->name)
                                        <span
                                            class="badge badge-success">{{ $data['roles']->where('id',$usuario->role_id)->first()->name }}</span>
                                    @else
                                        <span class="badge badge-dark">{{ 'Nenhum' }}</span>
                                    @endisset
                                    {{-- (isset() ? '<span class="badge badge-success">'.$data['roles']->where('id',$usuario->role_id)->first()->name.'</span>' : 'Nenhum' --}}
                                </td>
                                <td class="btn-group" role="group">
                                    <a href="{{ route('usuarios.destroy',$usuario->user_id) }}"
                                       class="btn btn-danger m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('usuarios.edit',$usuario->user_id) }}"
                                       class="btn btn-success m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('usuarios.edit',$usuario->user_id) }}"
                                       class="btn btn-outline-success m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('usuarios.destroy',$usuario->user_id) }}" class="btn btn-outline-danger btn-icon m-1">
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
    <!-- end of col-->
    <!-- modal cadastro usuario -->
    <div class="modal fade" id="verifyModalContentUsuario" tabindex="-1" role="dialog"
         aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">Cadastrar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="recipient-name-2" class="col-form-label">Equipe</label>
                                <select name="equipe" id="equipe" class="form-control" required>
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($data['equipes'] as $equipe)
                                        <option value="{{ $equipe->id }}">{{ $equipe->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="recipient-name-2" class="col-form-label">Cargo</label>
                                <select name="cargo" id="cargo" class="form-control" required>
                                    <option value="" selected>---Selecione---</option>
                                    @foreach($data['cargos'] as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name-2" class="col-form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    @foreach($data['status'] as $status)
                                        <option
                                            value="{{ $status->id }}" {{ ($status->nome == 'ativo') ? 'selected' : '' }}>{{ $status->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Matricula</label>
                                <input type="text" class="form-control" id="matricula" name="matricula">
                            </div>
                            <div class="col-md-8 mt-1">
                                <label for="recipient-name-2" class="col-form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Senha</label>
                            <input type="password" class="form-control" id="recipient-name-2" name="senha">
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
    <!-- modal cadastro cargo -->
    <div class="modal fade" id="verifyModalContentCargo" tabindex="-1" role="dialog"
         aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalContent_title">Cadastrar Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('cargo.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="nome_cargo" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name-2" class="col-form-label">Cargos Cadastrados</label>
                            <select name="cargo" id="cargo" class="form-control" multiple readonly rows="5">
                                @foreach($data['cargos'] as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Criar Cargo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
