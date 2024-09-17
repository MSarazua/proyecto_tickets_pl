@extends('layouts.admin')
@section('content')
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
      <div class="card card-rounded">
        <div class="card-body">
          <div class="d-sm-flex justify-content-between align-items-start">
            <div>
              <h4 class="card-title card-title-dash">Listado de tareas</h4>
              <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>
            </div>
            <div>
              <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
            </div>
          </div>
          <div class="table-responsive  mt-1">
            <table class="table select-table">
              <thead>
                <tr>
                  <th>
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" aria-checked="false" id="check-all"><i class="input-helper"></i></label>
                    </div>
                  </th>
                  <th>Solicitante</th>
                  <th>Área</th>
                  <th>Título del requerimiento</th>
                  <th>Prioridad</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($objetc as $item)
                  <tr>
                    <td>
                      <div class="form-check form-check-flat mt-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex ">
                        <img src="assets/images/faces/face1.jpg" alt="">
                        <div>
                          <h6>{{ $item->user->name }}</h6>
                          <p>Head admin</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h6>{{ $item->area->name }}</h6>
                      <p>company type</p>
                    </td>
                    <td>
                      <div class="d-flex ">
                        <div>
                          <h6>{{ $item->requirement_title }}</h6>
                          <p>Head admin</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex ">
                        <div>
                          <h6>{{ $item->priority }}</h6>
                          <p>Head admin</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="badge badge-opacity-warning">In progress</div>
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
@endsection