@extends('admin.main_master')

@section('main')

    <!-- Editar Profissionais -->
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="w-50 float-left card-title m-0">Cadastro de Profissionais - Matricula : {{ $usuario->matricula }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('usuarios.update',$usuario->user_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Nome</p>
                            <input type="text" placeholder="Usuario" value="{{ $usuario->nome_usuario }}"
                                   class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Cargo</p>
                            <select id="cargo" name="cargo" class="form-control" required>
                                @foreach($data['cargos'] as $cargo)
                                    <option
                                        value="{{ $cargo->id }}" {{ ($usuario->cargo_id == $cargo->id) ? 'selected' : '' }}>{{$cargo->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Status</p>
                            <select id="status" name="status" class="form-control" required>
                                @foreach($data['status'] as $status)
                                    <option
                                        value="{{ $status->id }}" {{ ($usuario->status_id == $status->id) ? 'selected' : '' }}>{{$status->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <p class="font-weight-400 mb-2">Email</p><input type="text" placeholder=""
                                                                            value="{{ $usuario->email }}"
                                                                            class="form-control" readonly>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Equipe</p>
                            <select id="equipe" name="equipe" class="form-control" required>
                                @foreach($data['equipes'] as $equipe)
                                    <option
                                        value="{{ $equipe->id }}" {{ ($usuario->equipe_id == $equipe->id) ? 'selected' : '' }}>{{$equipe->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <p class="font-weight-400 mb-2">Permissão</p>
                            <select id="role" name="role" class="form-control">
                                <option value="" selected>---Nenhum---</option>
                                @foreach($data['roles'] as $role)
                                    <option
                                        value="{{ $role->id }}" {{ ($usuario->role_id == $role->id) ? 'selected' : '' }}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <a href="{{ route('usuarios') }}" class="btn float-right btn-primary ml-3">Voltar</a>
                    <button type="submit" class="btn float-right btn-primary ml-3">Editar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Editar Profissionais -->
@endsection
