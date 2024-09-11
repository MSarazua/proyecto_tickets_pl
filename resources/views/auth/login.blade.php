@extends('layouts.login')

@section('content')
    <div class="card-header">{{ __('Login') }}</div>
                <form class="pt-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password"" placeholder="Password" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="auth-link text-black" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="auth-link text-black" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mt-3 d-grid gap-2">
                            <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                                {{ __('Iniciar Sesión') }}
                            </button>
                        </div>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="auth-link text-black" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>
                    <div class="text-center mt-4 fw-light"> ¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-primary">Registrarse</a>
                    </div>
                  </form>
@endsection
