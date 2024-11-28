@extends('admin.main_master')

@section('main')

    <div  class="mb-4 col-md-12 mt-3" align="right">
        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContentUsuario" data-whatever="@mdo">Cadastrar Usuário</button>
        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#verifyModalContentCargo" data-whatever="@mdo">Criar Novo Cargo</button>
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
                                        <th scope="col" style="width: 8%">AÇÕES</th>
                                        <th scope="col" style="width: 15%">MATRICULA</th>
                                        <th scope="col" style="width: 25%">NOME</th>
                                        <th scope="col" style="width: 20%">CARGO</th>
                                        <th scope="col" style="width: 20%">EQUIPE</th>
                                        <th scope="col" style="width: 12%">STATUS</th>
                                        <th scope="col" style="width: 12%">PERMISSÃO</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($usuarios as $usuario)
                                        <td>
                                            <a href="{{ route('usuarios.edit',$usuario->user_id) }}" class="text-success mr-2">
                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                            </a>
                                            <a href="{{ route('usuarios.destroy',$usuario->user_id) }}" class="text-danger mr-2">
                                                <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                            </a>
                                        </td>
                                        <td data-toggle="tooltip" data-placement="top" title="{{ $usuario->email }}" data-original-title="{{ $usuario->email }}" style="cursor: pointer;"><b>{{ $usuario->matricula }}</b></td>
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
                                            <span class="badge badge-success">{{ $data['roles']->where('id',$usuario->role_id)->first()->name }}</span>
                                            @else
                                                <span class="badge badge-dark">{{ 'Nenhum' }}</span>
                                            @endisset
                                            {{-- (isset() ? '<span class="badge badge-success">'.$data['roles']->where('id',$usuario->role_id)->first()->name.'</span>' : 'Nenhum' --}}
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
                <div class="modal fade" id="verifyModalContentUsuario" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
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
                                <div class="modal-body"  >
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
                                                    <option value="{{ $status->id }}" {{ ($status->nome == 'ativo') ? 'selected' : '' }}>{{ $status->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <label for="recipient-name-2" class="col-form-label">Matricula</label>
                                            <input type="text" class="form-control" id="matricula" name="matricula" >
                                        </div>
                                        <div class="col-md-8 mt-1">
                                            <label for="recipient-name-2" class="col-form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" >
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name-2" class="col-form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" >
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name-2" class="col-form-label">Senha</label>
                                        <input type="password" class="form-control" id="recipient-name-2" name="senha" >
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
                <div class="modal fade" id="verifyModalContentCargo" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true" style="display: none;">
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
                                <div class="modal-body"  >
                                    <div class="form-group">
                                            <label for="recipient-name-2" class="col-form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome_cargo" name="nome" required>
                                    </div>
                                    <div class="form-group">
                                            <label for="recipient-name-2" class="col-form-label">Cargos Cadastrados</label>
                                            <select name="cargo" id="cargo" class="form-control" multiple readonly rows="5"">
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
