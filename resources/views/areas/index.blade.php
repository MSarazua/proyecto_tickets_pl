@extends('layouts.admin')
@section('content')
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
      <div class="card card-rounded">
        <div class="card-body">
          <div class="d-sm-flex justify-content-between align-items-start">
            <div>
              <h4 class="card-title card-title-dash">Listado de áreas</h4>
              <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>
            </div>
            <div>
              <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
            </div>
          </div>
          <div class="table-responsive pt-3">
            <table class="table table-bordered">
                <thead>
                  <tr>
                      <th> ID </th>
                      <th> Nombre </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($object as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection