<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="@yield('keywords')"/>
    <meta content="" name="@yield('description')"/>
    <title>Sistema de O.S</title>

    <!--  ============ Favicon  =============  -->
    <link href="{{ asset('assets/images/checkmark.svg') }}" rel="icon"/>

    <!--  ============ Styles  =============  -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/perfect-scrollbar.css') }}">
    @include('admin.body.style')

    <!--  ============ Add Dynamic Styles  =============  -->
    @yield('style')

</head>

<body class="text-left">

<!-- Pre Loader Start  -->
{{--<div class='loadscreen' id="preloader">--}}
{{--    <div class="loader spinner-bubble spinner-bubble-primary">--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Pre Loader end  -->


<div class="app-admin-wrap layout-sidebar-large clearfix">

    <!-- Top Menu and Left Side Menu -->
    @include('admin.body.header');
    <!-- header top menu end -->
    <!--=============== Left side End ================-->
    @include('admin.body.sidemenu');

    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        <div class="breadcrumb">
            <h1 class="mr-2"></h1>
            <ul>
                <li><a href=""></a></li>

            </ul>
        </div>
{{--        <div class="separator-breadcrumb border-top"></div>--}}

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

    <!-- start of row-->
    <div class="row">
        @yield('main')
    </div>
    <!-- end of row-->
    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->


</div>

<!-- ============ Scripts Start ============= -->
@include('admin.body.scripts')

<!--  ============ Add Scripts Dynamic ============= -->
@yield('scripts')

<!--  ============ Footer  =============  -->
</body>
</html>
