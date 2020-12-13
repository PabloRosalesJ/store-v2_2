<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Store</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Styles -->
    @yield('extra_css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/all.css') }}" rel="stylesheet"> --}}

</head>


<body>

</body>
    <div id="app">
        <example-component></example-component>
    </div>
{{-- <div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
        <div class="h-100 d-md-flex align-items-center auth-side-img">
            <div class="col-sm-10 auth-content w-auto">
                <img src="{{ asset('img/fox-login.jpg') }}" alt="" class="img-fluid">
                <h1 class="text-white my-4">Hola de nuevo!</h1>
                <h4 class="text-white font-weight-normal">Inicia sesión para ingresar a Store.</h4>
            </div>
        </div>
        <div class="auth-side-form">
            <div class=" auth-content">
                <img src="{{ asset('img/fox-login.jpg') }}" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
                <form method="POST" action="/login">
                    @csrf
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block shadow redounded">
                                {{ __('Login') }}
                            </button>

                            <div class="col-12 text-center">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col text-center">
                            <p class="text-muted m-0 p-0">By PabloJRJ <i class="fas fa-headphones"></i></p>
                            <p class="text-muted m-0 p-0">whit <i class="feather icon-heart-on"></i></p>
                            <p class="text-muted m-0 p-0"><span class="text-monospace">Store v2.2</span> <i class="fab fa-github-square"></i></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('js/scripts.js') }}" ></script>
</body>

</html>
