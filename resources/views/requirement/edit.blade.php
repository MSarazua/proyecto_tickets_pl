@extends('layouts.admin')
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
        .btn-social-icon-text-edit {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            min-height: 44px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>DETALLE DEL REQUERIMIENTO</h1>
        </div>
        <form action="{{ route('requerimientos.update', $objetc->id) }}" method="POST" enctype="multipart/form-data">
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
                                                        <div>
                                                            <h6>{{ $objetc->devUser->name }}</h6>
                                                            <p>Desarrollador</p>
                                                        </div>
                                                    </div>
                                                    <select name="dev_user_id" class="js-example-basic-single w-100">
                                                        <option value="" disabled selected>Cambiar desarrollador</option>
                                                        @foreach ($devUsers as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn btn-dark btn-icon-text text-light mt-2">
                                                        Asignar nuevo
                                                        <i class="ti-reload btn-icon-append"></i>
                                                    </button>
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
                                    @if ($objetc->status == 0)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="0" checked=""> Pendiente <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="1"> En progreso <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="2"> Finalizado <i class="input-helper"></i></label>
                                        </div>
                                    @elseif ($objetc->status == 1)
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
                                            <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="2"> Finalizado <i class="input-helper"></i></label>
                                        </div>
                                    @elseif ($objetc->status == 2)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="0"> Pendiente <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="1"> En progreso <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input name="status" type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="2" checked=""> Finalizado <i class="input-helper"></i></label>
                                        </div>
                                    @endif
                                </div>       
                                <div class="text-center">
                                    <button type="submit" style="color: white !important" class="btn btn-dark btn-icon-text text-light"> Actualizar status
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
                    <h5>Archivos del requerimiento</h5>
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
                <div class="logs-section mt-4">
                    <h5>Historial</h5>
                    <div class="accordion" id="logsAccordion">
                        @forelse ($logs as $log)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $log->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $log->id }}" aria-expanded="false" aria-controls="collapse{{ $log->id }}">
                                        <strong>{{ $log->user->name }}:</strong> {{ Str::limit($log->description, 50) }} <!-- Mostrar solo una parte de la descripción -->
                                    </button>
                                </h2>
                                <div id="collapse{{ $log->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $log->id }}" data-bs-parent="#logsAccordion">
                                    <div class="accordion-body">
                                        <div class="d-flex justify-content-between">
                                            <span><strong>Fecha:</strong> {{ $log->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                
                                        <!-- Edición de descripción -->
                                        <textarea name="logs[{{ $log->id }}][description]" class="form-control mt-2">{{ $log->description }}</textarea>
                
                                        <div class="files-section mt-3">
                                            <h5>Archivos asociados</h5>
                                            <ul class="file-list">
                                                @php $hasFiles = false; @endphp
                                                @foreach ($ticketLogDetails as $detail)
                                                    @if ($detail->ticket_id == $log->id)
                                                        <li>
                                                            <a href="{{ asset('storage/' . $detail->files) }}" download>
                                                                {{ basename($detail->files) }}
                                                            </a>
                                                        </li>
                                                        @php $hasFiles = true; @endphp
                                                    @endif
                                                @endforeach
                
                                                @if (!$hasFiles)
                                                    <li>No hay archivos asociados a este requerimiento.</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No hay logs registrados.</p>
                        @endforelse
                    </div>
                </div>                
                <div class="container mt-5">
                    <h5>Responder >></h5>
                    <textarea name="new_log[description]" class="form-control" placeholder="Escribe una descripción..."></textarea>
                    <div id="fileInputsContainer" class="mb-3">
                        <div class="input-group mb-3">
                            <input name="files[]" type="file" class="form-control">
                        </div>
                    </div>
                    <div class="template-demo">
                        <button type="button" class="btn-social-icon-text-edit  text-light btn btn-social-icon-text btn-youtube" id="addFileButton">
                            <i class="ti-plus text-light"></i> Agregar archivo
                        </button>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-dark">Actualizar Ticket</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    document.getElementById('addFileButton').addEventListener('click', function() {
        var container = document.getElementById('fileInputsContainer');
        
        // Crea un nuevo div para el input de archivo y el botón de eliminación
        var newDiv = document.createElement('div');
        newDiv.classList.add('input-group', 'mb-3');

        // Crea el nuevo input de archivo
        var newInput = document.createElement('input');
        newInput.name = 'files[]'; // Usa un nombre de array para manejar múltiples archivos en el servidor
        newInput.type = 'file';
        newInput.classList.add('form-control');
        
        // Crea el botón de eliminación
        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-file-btn');
        removeButton.textContent = 'Eliminar';

        // Añade el input y el botón al nuevo div
        newDiv.appendChild(newInput);
        newDiv.appendChild(removeButton);
        
        // Añade el nuevo div al contenedor
        container.appendChild(newDiv);
    });

    document.getElementById('fileInputsContainer').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-file-btn')) {
            var divToRemove = event.target.parentElement;
            divToRemove.remove(); // Elimina el div contenedor del input y el botón de eliminación
        }
    });
</script>
@endsection

