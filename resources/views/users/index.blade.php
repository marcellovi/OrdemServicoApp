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
                                        <th scope="col">AÇÕES</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">CARGO</th>
                                        <th scope="col">EQUIPE</th>
                                        <th scope="col">PERMISSÃO</th>
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
                                        <td><b>{{ $usuario->email }}</b></td>
                                        <td>
                                            {{ (isset($data['cargos']->where('id',$usuario->cargo_id)->first()->nome)) ? $data['cargos']->where('id',$usuario->cargo_id)->first()->nome : 'Nenhum' }}
                                        </td>
                                        <td>
                                            {{ (isset($data['equipes']->where('id',$usuario->equipe_id)->first()->nome)) ? $data['equipes']->where('id',$usuario->equipe_id)->first()->nome : 'Nenhum' }}
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


            </div>
            <!-- end of row-->


    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->

<script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/vendor/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendor/datatables.min.js"></script>

<script src="assets/js/es5/echart.options.min.js"></script>
<script src="assets/js/es5/dashboard.v2.script.min.js"></script>

<script src="assets/js/es5/script.min.js"></script>
<script src="assets/js/es5/sidebar.large.script.min.js"></script>


<!-- Session fade after some time -->
<script type="text/javascript">
    window.setTimeout("document.getElementById('msg_alert').style.display='none';", 4000);
</script>
</body>

</html>

