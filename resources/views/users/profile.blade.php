@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
         <h4 class="card-title">Mi Perfil</h4>
         <form class="forms-sample">
            <div class="form-group">
               <label for="exampleInputUsername1">Nombre</label>
               <input value="{{ $authenticatedUser->name }}" disabled type="text" class="form-control" id="exampleInputUsername1" placeholder="Nombre">
            </div>
            <div class="form-group">
               <label for="exampleInputEmail1">Correo electrónico</label>
               <input type="email" value="{{ auth()->user()->email }}" disabled class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
               <label for="exampleInputPassword1">Área</label>
               <input type="text" value="{{ $objetc->area->name }}" disabled class="form-control" id="exampleInputArea" placeholder="Área">
            </div>
         </form>
      </div>
   </div>
@endsection   