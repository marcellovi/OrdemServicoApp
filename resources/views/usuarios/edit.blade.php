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
                    <a href="{{ route('usuarios') }}" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        Voltar
                    </a>
                    <button type="submit" class="btn float-right btn-primary ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>&nbsp;
                        Editar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Editar Profissionais -->
@endsection
