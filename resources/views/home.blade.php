@extends('layouts.app2')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Pantalla principal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>

  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">
        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Hoy</a></li>
                <li><a class="dropdown-item" href="#">Este mes</a></li>
                <li><a class="dropdown-item" href="#">Este año</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Lista Actividades <span>| Hoy</span></h5>

              <!-- Tabla con la clase 'datatable' para habilitar DataTables -->
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Horario</th>
                    <th scope="col">Fecha de creacion</th>
                    <th scope="col">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><a href="#">1</a></th>
                    <td>JUL-AGO 2025</td>
                    <td>Mar 14.00-16.00</td>
                    <td>01-02-2025</td>
                    <td><span class="badge bg-success">Completo</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">2</a></th>
                    <td>ENE-ABR 2025</td>
                    <td>Mier 14.00-16.00</td>                    
                    <td>04-07-2025</td>
                    <td><span class="badge bg-warning">Pendiente</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">3</a></th>
                    <td>OTC-DEC 2025</td>
                    <td>Mar 14.00-16.00</td>
                    <td>02-06-2025</td>
                    <td><span class="badge bg-success">Completo</span></td>
                  </tr>                  
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- End Recent Sales -->
      </div>
    </div>
  </div>

</main>

@endsection

<!-- Incluir los scripts necesarios para DataTables -->
@section('scripts')
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  
  <!-- jQuery (necesario para DataTables) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      // Inicializar DataTable en la tabla con la clase 'datatable'
      $('.datatable').DataTable({
        "searching": true,  // Habilitar búsqueda
        "columnDefs": [
          {
            "targets": [1],  // Especificamos que la columna "Nombre Act" (índice 3) será la que se buscará
            "searchable": true  // Habilitar búsqueda solo para esta columna
          }
        ]
      });
    });
  </script>
@endsection
