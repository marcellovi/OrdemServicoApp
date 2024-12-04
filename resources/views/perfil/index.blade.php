@extends('admin.main_master')

<!-- row -->
@section('main')
    <div class="col-lg-4 col-xl-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div class="user-profile mb-4">
                    <div class="ul-widget-card__user-info">
                        <img class="profile-picture avatar-lg mb-2" src="{{ (Auth::user()->avatar) ? Storage::url(Auth::user()->avatar) : asset('assets/images/no_user.png') }}" alt="">
{{--                        <img class="profile-picture avatar-lg mb-2" src="{{ asset(Storage::url(Auth::user()->avatar))  }}" alt="">--}}
                        <p class="m-0 text-24">{{ $usuario->name }}</p>
                        <p class="text-muted m-0">{{ $usuario->equipe_nome }}</p>
                    </div>
                </div>
                <!-- info -->
                <div class="ul-widget-card__full-status mb-3">
                    <div class="ul-widget-card__status1">
                        <span>797</span>
                        <span class="text-mute">OS Abertos</span>
                    </div>
                    <div class="ul-widget-card__status1">
                        <span>90</span>
                        <span class="text-mute">Chamados Abertos</span>
                    </div>
                    <div class="ul-widget-card__status1">
                        <span>255</span>
                        <span class="text-mute">Horas</span>
                    </div>
                </div>
                <!-- buttons links -->
                <div class="ul-widget-card--line mt-2">
{{--                    <button type="button" class="btn btn-primary ul-btn-raised--v2  m-1">Download</button>--}}
{{--                    <button type="button" class="btn btn-outline-success ul-btn-raised--v2 m-1 float-right">Preview</button>--}}
                </div>
                <!-- buttons links -->
                <div class="ul-widget-card__rate-icon">
                    <span>
                       <i class="i-Add-UserStar text-success"></i>
                      {{ ($usuario->status_nome) ? $usuario->status_nome : '(Nenhum)' }}
                   </span>
                    <span>
                       <i class="i-Engineering text-primary"></i>
                       {{ ($usuario->cargo_nome) ? $usuario->cargo_nome : '(Nenhum)' }}
                   </span>
                    <span>
                       <i class="i-Diploma-2 text-primary"></i>
                          {{ ($usuario->role_nome) ? $usuario->role_nome : '(Nenhum)' }}
                   </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-xl-12 mt-3">
        <form id="send-verification" method="post" action="{{ route('perfil.update',$usuario->id) }}">
            @csrf
            @method('PUT')
        <div class="card-body">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Informações do Perfil do Usuário
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Atualize informações de Nome e Email.
                </p>
            </header>
            <div class="d-flex flex-column">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="" value="{{ $usuario->name }}" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="" value="{{ $usuario->email }}" required>
                </div>
                <button class="btn btn-primary pd-x-20">Atualizar Perfil</button>
            </div>
        </div>
        </form>
    </div>

    <div class="col-lg-4 col-xl-12 mt-3">
        <form id="send-verification" method="post" action="{{ route('avatar.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $usuario->id }}">
            <div class="card-body">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                       Atualizar Avatar / Imagem
                    </h2>
                </header>
                <div class="d-flex flex-column">
                    <div class="form-group">
                        <input type="file" class="form-control" name="avatar" placeholder="" value="" >
                    </div>
                    <button class="btn btn-primary pd-x-20">Atualizar Avatar</button>
                </div>
            </div>
        </form>
    </div>



@endsection

