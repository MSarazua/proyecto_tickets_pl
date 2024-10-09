@extends('layouts.admin')
@section('content')
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
      <div class="card card-rounded">
        <div class="card-body">
          <div class="d-sm-flex justify-content-between align-items-start">
            <div>
              <h4 class="card-title card-title-dash">Listado de tareas</h4>
            </div>
            <div>
              <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
            </div>
          </div>
          <div class="table-responsive  mt-1">
            <table id="requirementTable" class="table table-striped table-bordered tableExport">
              <thead>
                <tr>
                  <th>
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" aria-checked="false" id="check-all"><i class="input-helper"></i></label>
                    </div>
                  </th>
                  <th>Fecha de solicitud</th>
                  <th>Solicitante</th>
                  <th>Área</th>
                  <th>Título del requerimiento</th>
                  <th>Prioridad</th>
                  @if ($currentUser->hasRole('Admin'))
                    <th>Asignado a</th>
                  @endif  
                  <th>Estado</th>
                  <th>Acciones</th>
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
                      <h6>{{ $item->created_at }}</h6>
                    </td>
                    <td>
                      <div class="d-flex ">
                        <div>
                          <h6>{{ $item->user->name }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h6>{{ $item->area->name }}</h6>
                    </td>
                    <td>
                      <div class="d-flex ">
                        <div>
                          <h6>{{ $item->requirement_title }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex">
                        <div>
                            @if ($item->priority == 0)
                                <div class="badge badge-opacity-danger">Alta</div>
                            @elseif ($item->priority == 1)
                                <div class="badge badge-opacity-warning">Media</div>
                            @elseif ($item->priority == 2)
                                <div class="badge badge-opacity-success">Baja</div>  
                            @endif
                        </div>
                      </div>                    
                    </td>
                    @if ($currentUser->hasRole('Admin'))
                      <td>
                        @if ($item->devUser)
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6>{{ $item->devUser->name }}</h6>
                                </div>
                            </div>
                        @else
                            <p>No asignado</p>
                        @endif
                      </td>
                    @endif
                    <td>
                      <div class="progress">
                        @if ($item->status == 0)
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="25"></div>
                        @elseif ($item->status == 1)
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="50"></div>
                        @elseif ($item->status == 2)
                          <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        @endif
                      </div>
                    </td>
                    <td>
                      <div class="template-demo d-flex justify-content-between flex-nowrap">
                        <a href="{{ route('requerimientos.edit', $item->id) }}" title="Detalle" type="button" class="btn btn-inverse-dark btn-icon">
                          <i class="fa fa-edit"></i>
                        </a>
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
@endsection