@extends('layouts.admin')
@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Crear una nueva solicitud</h4>
        <form class="forms-sample material-form bordered" method="POST" action="{{ route('requerimientos.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ auth()->user()->id }}" required="required" name="user_id">
            <div class="form-group">
                <input type="text" required="required" name="requirement_title">
                <label for="input" class="control-label">Título de la solicitud</label><i class="bar"></i>
            </div>
            <div class="form-group">
                <select name="area" class="js-example-basic-single w-100">
                    <option selected>Área de solicitud</option>
                    @foreach ($objetc as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
              </div>
            <div class="mt-5">
                <p class="card-description">Prioridad </p>
                <div class="form-check">
                   <label class="form-check-label">
                   <input name="priority" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="0"> Alta <i class="input-helper"></i></label>
                </div>
                <div class="form-check">
                   <label class="form-check-label">
                   <input name="priority" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="1" checked=""> Media <i class="input-helper"></i></label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                    <input name="priority" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="2" checked=""> Baja <i class="input-helper"></i></label>
                 </div>
            </div>
            <div class="form-group">
                <div class="form-floating">
                    <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Descripción</label><i class="bar"></i>
                </div>
            </div>
            <div class="form-group">
                <div class="form-floating">
                    <textarea name="references" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Referencias</label><i class="bar"></i>
                </div>
            </div>
            <div class="container mt-5">
                <h5 class="card-title">Adjuntar archivos</h5>
                <div id="fileInputsContainer" class="mb-3">
                    <!-- Contenedor para los inputs de archivo -->
                    <div class="input-group mb-3">
                        <input name="files[]" type="file" class="form-control">
                    </div>
                </div>
                <div class="template-demo">
                    <button type="button" class="text-light btn btn-social-icon-text btn-youtube" id="addFileButton">
                        <i class="ti-plus text-light"></i> Agregar archivo
                    </button>
                </div>
            </div>
            <div class="button-container text-center template-demo">
                <button type="submit" class="btn btn-primary btn-icon-text text-light">
                  <i class="ti-file btn-icon-prepend text-light"></i> Enviar solicitud </button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection