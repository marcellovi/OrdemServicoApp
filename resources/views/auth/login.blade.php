<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de OS</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/css/themes/lite-purple.min.css">
</head>

<body class="text-left">
<div class="auth-layout-wrap" style="background-image: url(./assets/images/photo-wide-4.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4">
                            <img src="assets/images/er_profile.png" alt="">
                        </div>
                        <h1 class="mb-3 text-18">Log In</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" >Email</label>
                                <input id="email" class="form-control form-control-rounded" type="email" name="email" required="required" autofocus="autofocus" autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input id="password" class="form-control form-control-rounded" type="password" name="password" required="required">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2" >Log In</button>

                        </form>

                        <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-muted"><u>Esqueceu Senha?</u></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center " style="background-size: cover;background-image: url(./assets/images/photo-long-3.jpg)">
                    <div class="pr-3 auth-right">
                        <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="#">
                            <i class="i-Mail-with-At-Sign"></i> ER Email Contato
                        </a>
                        <a class="btn btn-rounded btn-outline-google btn-block btn-icon-text">
                            <i class="i-Support"></i> ER Suporte
                        </a>
                        <a class="btn btn-rounded btn-block btn-icon-text btn-outline-success" target="_blank" href="https://wa.me/+5521980630330?text=Assistencia no Login">
                            <i class="i-Consulting"></i> ER Whatsapp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/es5/script.min.js"></script>
</body>

</html>
