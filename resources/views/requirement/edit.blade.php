@extends('layouts.admin')
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .header {
            /* Gradiente en el encabezado */
            background: linear-gradient(135deg, #007bff, #00c3ff);
            padding: 20px;
            color: white;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
        }
        .form-section {
            background-color: white;
            padding: 20px;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .divider {
            height: 1px;
            background-color: #007bff;
            margin: 20px 0;
        }
        .files-section {
            margin-top: 30px;
        }
        .file-list {
            list-style-type: none;
            padding-left: 0;
        }
        .file-list li {
            padding: 10px;
            background-color: #f1f1f1;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .file-list li a {
            color: #007bff;
            text-decoration: none;
        }
        .file-list li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>DETALLE DEL REQUERIMIENTO</h1>
        </div>
        <form action="{{ route('requerimientos.update', $objetc->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Título</th>
                                        <td>{{ $objetc->requirement_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Referencias</th>
                                        <td><a href="{{ $objetc->references }}">{{ $objetc->references }}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Solicitado por:</th>
                                        <td>{{ $objetc->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Área de solicitud</th>
                                        <td>{{ $objetc->area->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de solicitud</th>
                                        <td>{{ $objetc->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Prioridad</th>
                                        
                                        @if ($objetc->priority == 0)
                                            <td><label class="badge badge-danger">Alta</label></td>
                                        @elseif ($objetc->priority == 1)
                                            <td><label class="badge badge-warning">Media</label></td>
                                        @elseif ($objetc->priority == 2)
                                            <td><label class="badge badge-success">Baja</label></td>
                                        @endif
                                    </tr>
                                    @if ($currentUser->hasRole('Admin'))
                                        <tr>
                                            @if ($objetc->devUser)
                                                <th>Asignado a:</th>
                                            @else    
                                                <th>Asignar tarea:</th>
                                            @endif
                                            <td>
                                                @if ($objetc->devUser)
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="" class="mr-3">
                                                        <div>
                                                            <h6>{{ $objetc->devUser->name }}</h6>
                                                            <p>Head admin</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <select name="dev_user_id" class="js-example-basic-single w-100">
                                                        <option value="" disabled selected>Seleccione un desarrollador</option>
                                                        @foreach ($devUsers as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn btn-dark btn-icon-text text-light"> Asignar 
                                                        <i class="ti-file btn-icon-append"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <textarea style="width: 100%; height: 200px">{{ $objetc->description }}</textarea>
                            @if ($currentUser->hasRole('Dev'))
                                <div class="mt-5">
                                    <p class="card-description">Status </p>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                    <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="0"> Pendiente <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                    <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="1" checked=""> En progreso <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="2" checked=""> Finalizado <i class="input-helper"></i></label>
                                    </div>
                                </div>       
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark btn-icon-text text-light"> Actualizar status
                                        <i class="ti-file btn-icon-append"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Divider line -->
                <div class="divider"></div>

                <!-- Files Section -->
                <div class="files-section">
                    <h3>Archivos del requerimiento</h3>
                    <ul class="file-list">
                        @forelse ($objetc->details as $detail)
                            <li>
                                <a href="{{ asset('storage/' . $detail->files) }}" download>
                                    {{ basename($detail->files) }}
                                </a>
                            </li>
                        @empty
                            <li>No hay archivos asociados a este requerimiento.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection