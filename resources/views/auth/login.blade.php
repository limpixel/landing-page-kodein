<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Pesantren Koding | Pesantren IT | Pesantren Enterpreneur | Pondok IT</title>
	<meta name="description" content="Pesantren Koding, Pesantren IT, Pesantren Enterpreneur, Pondok IT">
    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css2?family=Jost:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style-starter.css') }}">
    @yield('css')
    @yield('js')
</head>

<body>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 d-flex flex-column align-items-center justify-content-center">
    
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="d-flex align-items-center w-auto">
                                <img src="{{ asset('images/logo/KODEIN Transparan.png') }}" alt="Your logo"
                                    title="Your logo" style="height:60px;" />
                            </a>
                        </div><!-- End Logo -->
    
                        <div class="card mb-3">
    
                            <div class="card-body">
    
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                </div>
    
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
    
                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-md-12 col-form-label text-md-end">{{ __('Email Address') }}</label>
    
                                        <div class="col-md-12">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="row mb-3">
                                        <label for="password"
                                            class="col-md-12 col-form-label text-md-end">{{ __('Password') }}</label>
    
                                        <div class="col-md-12">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">
    
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
    
                                    <div class="row mb-3">
                                        <div class="col-md-12 ">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row mb-0 justify-content-center">
                                        <div class="col-md-12 ">
                                            <button type="submit" class="btn btn-primary form-control">
                                                {{ __('Login') }}
                                            </button>
    
                                        </div>
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </form>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </section>
    
    </div>
</body>
