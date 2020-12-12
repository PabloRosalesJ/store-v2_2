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

    <div class="auth-wrapper align-items-stretch aut-bg-img">
        <div class="flex-grow-1">
            <div class="h-100 d-md-flex align-items-center auth-side-img">
                <div class="col-sm-10 auth-content w-auto">
                    <img src="assets/images/auth/auth-logo.png" alt="" class="img-fluid">
                    <h1 class="text-white my-4">Hola de nuevo!</h1>
                    <h4 class="text-white font-weight-normal">Inicia sesión para ingresar a Store.</h4>
                </div>
            </div>
            <div class="auth-side-form">
                <div class=" auth-content">

                    <img src="{{ asset('img/fox-login.jpg') }}" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">

                    <form action="action="{{ route('login') }}" method="post">
                    @csrf
                    <h3 class="mb-4 f-w-400">Iniciar sesión</h3>
                    <div class="form-group mb-3">
                        <label class="floating-label" for="Email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="Password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center text-muted">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Olvidaste tu password?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="text-center">
                        <p class="mb-2 mt-4 text-muted">Forgot password? <a href="auth-reset-password-img-side.html" class="f-w-400">Reset</a></p>
                        <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup-img-side.html" class="f-w-400">Signup</a></p>
                    </div> --}}
                </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/scripts.js') }}" ></script>
</body>

</html>
