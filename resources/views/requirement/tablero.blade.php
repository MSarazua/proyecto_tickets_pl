@extends('layouts.admin')
@section('content')
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
      <div class="card card-rounded">
        <div class="card-body">
          <div class="d-sm-flex justify-content-between align-items-start">
            <div>
              <h4 class="card-title card-title-dash">Estado de tareas</h4>
              <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>
            </div>
            <div>
              <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
            </div>
          </div>
          <div class="table-responsive mt-1">
            <table class="table select-table">
                <thead>
                    <tr>
                        <th>Pendiente</th>
                        <th>En progreso</th>
                        <th>Finalizado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- Columna para Pendientes --}}
                        <td>
                            @foreach ($objetc as $item)
                                @if ($item->status == "0")
                                <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                    <div class="card bg-danger card-rounded">
                                    <div class="card-body pb-0">
                                        <h4 class="card-title card-title-dash text-white mb-4">Pendiente</h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <a href="{{ route('requerimientos.edit', $item->id) }}" title="Detalle" type="button" class="btn btn-lg text-light btn-inverse-dark btn-icon">
                                                    {{ $item->requirement_title }}
                                                </a>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="status-summary-chart-wrapper pb-4">
                                                <canvas id="status-summary" width="181" height="66" style="display: block; box-sizing: border-box; height: 66px; width: 181px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </td>
        
                        {{-- Columna para En progreso --}}
                        <td>
                            @foreach ($objetc as $item)
                                @if ($item->status == "1")
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card bg-warning card-rounded">
                                        <div class="card-body pb-0">
                                            <h4 class="card-title card-title-dash text-white mb-4">En progreso</h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <a href="{{ route('requerimientos.edit', $item->id) }}" title="Detalle" type="button" class="btn btn-lg text-light btn-inverse-dark btn-icon">
                                                        {{ $item->requirement_title }}
                                                    </a>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="status-summary-chart-wrapper pb-4">
                                                    <canvas id="status-summary" width="181" height="66" style="display: block; box-sizing: border-box; height: 66px; width: 181px;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </td>
        
                        {{-- Columna para Finalizados --}}
                        <td>
                            @foreach ($objetc as $item)
                                @if ($item->status == "2")
                                <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                    <div class="card bg-success card-rounded">
                                    <div class="card-body pb-0">
                                        <h4 class="card-title card-title-dash text-white mb-4">Finalizado</h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <a href="{{ route('requerimientos.edit', $item->id) }}" title="Detalle" type="button" class="btn btn-lg text-light btn-inverse-dark btn-icon">
                                                    {{ $item->requirement_title }}
                                                </a>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="status-summary-chart-wrapper pb-4">
                                                <canvas id="status-summary" width="181" height="66" style="display: block; box-sizing: border-box; height: 66px; width: 181px;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        </div>
      </div>
    </div>
  </div>
@endsection