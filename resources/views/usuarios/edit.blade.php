<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de O.S</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/perfect-scrollbar.css') }}">

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large clearfix">

    <!-- Top Menu and Left Side Menu -->
    @include ('admin.body.sidemenu');
    <!--=============== Left side End ================-->

    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column">

        <!-- breadcrumb -->
        <div class="breadcrumb">
            <h1 class="mr-2">Sistema de OS</h1>
            <ul>
                <li><a href="">Dashboard</a></li>
                <li></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- msg alert -->
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if( session('type') == $msg)
                <div id="msg_alert" class="alert alert-card alert-{{ $msg }}" role="alert">
                    <strong class="text-capitalize">{{ session('status') }}!</strong> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
        @endforeach
        <!-- end msg alert -->


            <!-- body row -->
            <div class="row">

                <!-- Cadastro de Profissionais -->

                <div class="col-md">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="w-50 float-left card-title m-0">Cadastro de Profissionais</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('usuarios.update',$usuario->user_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <p class="font-weight-400 mb-2">Usuário</p>
                                    <input type="text" placeholder="Usuario" value="{{ $usuario->nome_usuario }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <p class="font-weight-400 mb-2">Cargo</p>
                                    <select id="cargo" name="cargo" class="form-control" required>
                                        <option value="" selected>---Selecione---</option>
                                        @foreach($data['cargos'] as $cargo)
                                        <option value="{{ $cargo->id }}" {{ ($usuario->cargo_id == $cargo->id) ? 'selected' : '' }}>{{$cargo->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <p class="font-weight-400 mb-2">Email</p><input type="text" placeholder="" value="{{ $usuario->email }}"
                                                                                  class="form-control" readonly>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <p class="font-weight-400 mb-2">Equipe</p>
                                    <select id="equipe" name="equipe" class="form-control" required>
                                        <option value="">---Selecione---</option>
                                        @foreach($data['equipes'] as $equipe)
                                            <option value="{{ $equipe->id }}" {{ ($usuario->equipe_id == $equipe->id) ? 'selected' : '' }}>{{$equipe->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <p class="font-weight-400 mb-2">Permissão</p>
                                    <select id="role" name="role" class="form-control" readonly="true">
                                        <option value="" selected>---Selecione---</option>
                                        @foreach($data['roles'] as $role)
                                            <option value="{{ $role->id }}" {{ ($usuario->role_id == $role->id) ? 'selected' : '' }}>{{$role->name}}</option>
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

                <!-- End Cadastro Profissionais -->



                <!-- end of col-->


            </div>
            <!-- end of row-->


    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->

<script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>

<script src="{{ asset('assets/js/es5/echart.options.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/dashboard.v2.script.min.js') }}"></script>

<script src="{{ asset('assets/js/es5/script.min.js') }}"></script>
<script src="{{ asset('assets/js/es5/sidebar.large.script.min.js') }}"></script>


<!-- Session fade after some time -->
<script type="text/javascript">
    window.setTimeout("document.getElementById('msg_alert').style.display='none';", 4000);
</script>
</body>

</html>

