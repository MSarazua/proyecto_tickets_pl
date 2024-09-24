@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
           <div class="card-body">
              <h4 class="card-title">Basic form elements</h4>
              <p class="card-description"> Basic form elements </p>
              <form class="forms-sample" method="POST" action="{{ route('register') }}">
                @csrf
                 <div class="form-group">
                    <label for="exampleInputName1">Nombre</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
                 <div class="form-group">
                    <label for="exampleInputEmail3">Correo electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                
                 </div>
                 <div class="form-group">
                    <label for="exampleInputPassword4">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
                 <div class="form-group">
                    <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                 <div class="form-group">
                    <label for="exampleSelectGender">Rol</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
                 <div class="form-group">
                    <label for="exampleSelectGender">Área</label>
                    <select id="area" class="form-control @error('area') is-invalid @enderror" name="area" required>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                    @error('area')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
              </form>
           </div>
        </div>
     </div>
</div>
@endsection
