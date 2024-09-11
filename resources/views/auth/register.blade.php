@extends('layouts.login')

@section('content')
    <div class="card-header">{{ __('Register') }}</div>
        <form class="pt-3" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" placeholder="Nombre" name="name" value="{{ old('name') }}" required autocomplete="email" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

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
                <input type="password" class="form-control" id="password-confirm" placeholder="Confirmar contraseña" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                        {{ __('Registrar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

