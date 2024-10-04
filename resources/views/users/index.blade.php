@extends('layouts.admin')
@section('content')
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
       <div class="card card-rounded">
          <div class="card-body">
             <div class="row">
                <div class="col-lg-12">
                   <div class="d-flex justify-content-between align-items-center mb-3">
                      <div>
                         <h4 class="card-title card-title-dash">Usuarios registrados</h4>
                      </div>
                   </div>
                   <div class="mt-3">
                    <table id="areasTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> Nombre </th>
                            <th> Fecha de creación </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="col-12 d-flex">
                                    <a href="{{ route('usuario.edit', $user->id) }}" title="Editar" type="button" class="btn btn-inverse-dark btn-icon">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <div class="wrapper ms-3">
                                        <p class="ms-1 mb-1 fw-bold">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="col-12">
                                    <div class="wrapper ms-3">
                                        <small class="text-muted mb-0">{{ $user->created_at }}</small>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection