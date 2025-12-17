@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .card {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }
    .card-header {
        background-color: transparent;
        border-bottom: 2px solid #0d6efd;
        font-weight: bold;
        text-align: center;
        font-size: 1.5rem;
        color: #333;
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .form-control {
        border-radius: 25px;
        padding: 10px 20px;
    }
    .btn-login {
        border-radius: 25px;
        font-weight: bold;
        padding: 10px 30px;
        width: 100%;
    }
</style>

<div class="container" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h1 class="text-white fw-bold text-shadow">Bengkel Pakar</h1>
                <p class="text-white">Silahkan login untuk mengelola sistem</p>
            </div>
            <div class="card p-4">
                <div class="card-header">{{ __('Login Staff') }}</div>

                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label text-muted">{{ __('Username') }}</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="admin">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-muted">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="********">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-login shadow">
                                    {{ __('LOGIN') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <div class="text-center mt-3">
                                        <a class="btn btn-link text-muted" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-white text-decoration-none">&larr; Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@endsection
