@extends('layouts.reports')
@section('content')
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="index.html">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" style="object-fit: scale-down" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="index.html">
        <img src="{{ asset('assets/images/prensalibre_logo.jpeg') }}" alt="logo" />
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item fw-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text">Hola, <span class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown d-none d-lg-block">
        <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
          <a class="dropdown-item py-3">
            <p class="mb-0 fw-medium float-start">Select category</p>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-item-content flex-grow py-2">
              <p class="preview-subject ellipsis fw-medium text-dark">Bootstrap Bundle </p>
              <p class="fw-light small-text mb-0">This is a Bundle featuring 16 unique dashboards</p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-item-content flex-grow py-2">
              <p class="preview-subject ellipsis fw-medium text-dark">Angular Bundle</p>
              <p class="fw-light small-text mb-0">Everything you’ll ever need for your Angular projects</p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-item-content flex-grow py-2">
              <p class="preview-subject ellipsis fw-medium text-dark">VUE Bundle</p>
              <p class="fw-light small-text mb-0">Bundle of 6 Premium Vue Admin Dashboard</p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-item-content flex-grow py-2">
              <p class="preview-subject ellipsis fw-medium text-dark">React Bundle</p>
              <p class="fw-light small-text mb-0">Bundle of 8 Premium React Admin Dashboard</p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item d-none d-lg-block">
        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
          <span class="input-group-addon input-group-prepend border-right">
            <span class="icon-calendar input-group-text calendar-icon"></span>
          </span>
          <input type="text" class="form-control">
        </div>
      </li>
      <li class="nav-item">
        <form class="search-form" action="#">
          <i class="icon-search"></i>
          <input type="search" class="form-control" placeholder="Search Here" title="Search here">
        </form>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="icon-bell"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
          <a class="dropdown-item py-3 border-bottom">
            <p class="mb-0 fw-medium float-start">You have 4 new notifications </p>
            <span class="badge badge-pill badge-primary float-end">View all</span>
          </a>
          <a class="dropdown-item preview-item py-3">
            <div class="preview-thumbnail">
              <i class="mdi mdi-alert m-auto text-primary"></i>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
              <p class="fw-light small-text mb-0"> Just now </p>
            </div>
          </a>
          <a class="dropdown-item preview-item py-3">
            <div class="preview-thumbnail">
              <i class="mdi mdi-lock-outline m-auto text-primary"></i>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
              <p class="fw-light small-text mb-0"> Private message </p>
            </div>
          </a>
          <a class="dropdown-item preview-item py-3">
            <div class="preview-thumbnail">
              <i class="mdi mdi-airballoon m-auto text-primary"></i>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
              <p class="fw-light small-text mb-0"> 2 days ago </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="icon-mail icon-lg"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
          <a class="dropdown-item py-3">
            <p class="mb-0 fw-medium float-start">You have 7 unread mails </p>
            <span class="badge badge-pill badge-primary float-end">View all</span>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="{{ asset('assets/images/faces/face10.jpg') }}" alt="image" class="img-sm profile-pic">
            </div>
            <div class="preview-item-content flex-grow py-2">
              <p class="preview-subject ellipsis fw-medium text-dark">Marian Garner </p>
              <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="{{ asset('assets/images/faces/face12.jpg') }}" alt="image" class="img-sm profile-pic">
            </div>
            <div class="preview-item-content flex-grow py-2">
              <p class="preview-subject ellipsis fw-medium text-dark">David Grey </p>
              <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image" class="img-sm profile-pic">
            </div>
            <div class="preview-item-content flex-grow py-2">
              <p class="preview-subject ellipsis fw-medium text-dark">Travis Jenkins </p>
              <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
            <p class="mb-1 mt-3 fw-semibold">{{ auth()->user()->name }}</p>
            <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
          </div>
          <a href="{{ url('usuario/show') }}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mi Perfil <span class="badge badge-pill badge-danger">1</span></a>
          <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
          <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
          <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
          </a>
        
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('reportes') }}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Reportes</span>
          </a>
        </li>
        <li class="nav-item nav-category">UI Elements</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="charts">
            <i class="menu-icon mdi mdi-account-outline"></i>
            <span class="menu-title">Usuarios</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="users">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ url('usuario') }}">Listado</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('register') }}">Agregar</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="menu-icon mdi mdi-floor-plan"></i>
            <span class="menu-title">Requerimientos</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ url('requerimientos/create') }}">Nuevo requerimiento</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('requerimientos') }}">Listado de tareas</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('tablero') }}">Tablero</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-card-text-outline"></i>
            <span class="menu-title">Áreas</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ url('areas') }}">Listado</a></li>
              <li class="nav-item">
                <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link">Agregar</a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-sm-12">
            <div class="home-tab">
              <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="statistics-details d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Tareas en Progreso</p>
                            <h3 class="rate-percentage">{{ $inProgressTasksCount }}</h3>
                            <p class="text-warning d-flex"><i class="mdi mdi-menu-up"></i><span>En progreso</span></p>
                        </div>
                        <div>
                            <p class="statistics-title">Tareas Finalizadas</p>
                            <h3 class="rate-percentage">{{ $completedTasksCount }}</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-check-circle"></i><span>Completadas</span></p>
                        </div>
                        <div>
                            <p class="statistics-title">Tareas Pendientes</p>
                            <h3 class="rate-percentage">{{ $pendingTasksCount }}</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>Pendientes</span></p>
                        </div>
                        <div class="d-none d-md-block">
                          <p class="statistics-title">Tiempo promedio de solución</p>
                          <h3 class="rate-percentage">{{ $averageCompletionTime }}</h3>
                        </div>                      
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-8 d-flex flex-column">
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Reporte de solicitudes por área</h4>
                                  </div>
                                  <div>
                                    <div class="dropdown">
                                      <button class="btn btn-light dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> This month </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <h6 class="dropdown-header">Settings</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                  <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                    <h2 class="me-2 fw-bold">{{ $totalTasksCount }}</h2>
                                  </div>
                                  <div class="me-3">
                                    <div id="marketingOverview-legend"></div>
                                  </div>
                                </div>
                                <div class="chartjs-bar-wrapper mt-3">
                                  <canvas id="marketingOverview"></canvas>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                  <h4 class="card-title card-title-dash">Reporte general</h4>
                                </div>
                                <div>
                                  <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
                                </div>
                              </div>
                              <div class="table-responsive  mt-1">
                                <table id="requirementTable" class="table table-striped table-bordered">
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
                    </div>
                    <div class="col-lg-4 d-flex flex-column">
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title card-title-dash">Estado de tareas</h4>
                                    <div class="add-items d-flex mb-0">
                                      <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                                      <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                    </div>
                                  </div>
                                  <div class="list-wrapper">
                                    <ul class="todo-list todo-list-rounded">
                                        @foreach($tasks as $task)
                                            <li class="d-block">
                                                <div class="form-check w-100">
                                                    <label class="form-check-label">
                                                        <input class="checkbox" type="checkbox" {{ $task->status == 2 ? 'checked' : '' }}> 
                                                        <span class="{{ $task->status == 2 ? 'text-decoration-line-through' : '' }}">
                                                            {{ $task->requirement_title }}
                                                        </span>
                                                        <i class="input-helper rounded"></i>
                                                    </label>
                                                    <div class="d-flex mt-2">
                                                        <div class="ps-4 text-small me-3">{{ $task->created_at->format('d M Y') }}</div>
                                                        <div class="badge badge-opacity-{{ $task->status == 0 ? 'danger' : ($task->status == 1 ? 'warning' : 'success') }} me-3">
                                                            {{ $task->status == 0 ? 'Pendiente' : ($task->status == 1 ? 'En Progreso' : 'Finalizado') }}
                                                        </div>
                                                        <i class="mdi mdi-flag ms-2 flag-color"></i>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div>
                                                    <h4 class="card-title card-title-dash">Tareas por desarrollador</h4>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                              @foreach($tasksByDevUser as $task)
                                                <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                    <div class="d-flex">
                                                        <img class="img-sm rounded-10" src="assets/images/faces/face{{ $loop->index + 1 }}.jpg" alt="profile">
                                                        <div class="wrapper ms-3">
                                                            @if($task->devUser)
                                                                <p class="ms-1 mb-1 fw-bold">{{ $task->devUser->name }}</p>
                                                            @else
                                                                <p class="ms-1 mb-1 fw-bold">Sin asignar</p>
                                                            @endif
                                                            <small class="text-muted mb-0">{{ $task->total }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="text-muted text-small"> 1h ago </div>
                                                </div>
                                              @endforeach                                          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('marketingOverview').getContext('2d');
        var marketingOverview = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($tasksByArea->pluck('area.name')),
                datasets: [{
                    label: 'Solicitudes por Área',
                    data: @json($tasksByArea->pluck('total')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection