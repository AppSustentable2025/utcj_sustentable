@extends('layouts.app2')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Lista de actividades</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item">Lista de actividades</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">Actividades creadas</h5>
            </div>
            <div class="d-flex justify-content-end mb-2">
              <a href="{{ route('actividades.create') }}" class="btn btn-primary btn-sm px-4">Nuevo</a>
            </div>

            <!-- Table with stripped rows -->
            <table id="actividadTable" class="table">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Periodo</th>
                  <th scope="col">Horario</th>
                </tr>
              </thead>
              <tbody>
                @foreach($actividades as $actividad)
                <tr data-id="{{ $actividad->id }}" class="parent-row">
                  <td><a href="javascript:void(0)"><strong>{{ $actividad->id }}</strong></a></td>
                  <td>{{ $actividad->Periodo }}</td>
                  <td>{{ $actividad->Horario }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <!-- Hidden student tables -->
            @foreach($actividades as $actividad)
            <div id="child-row-{{ $actividad->id }}" class="child-row mt-2 mb-4" style="display:none;">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID Alumno</th>
                    <th>Nombre</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($actividad->alumnos as $alumno)
                  <tr>
                    <td>
                      <a href="javascript:void(0)" class="alumno-link" data-id="{{ $alumno->id }}">
                      <strong>{{ $alumno->id }}</strong>
                      </a>
                    </td>
                    <td>{{ $alumno->nombre }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endforeach
            <!-- End Hidden student tables -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- End #main -->

@endsection

<!-- Scripts should be at the end -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    // Initialize DataTable first
    $('#actividadTable').DataTable();

    // Manejar el clic en las filas de la tabla
    $('#actividadTable tbody').on('click', 'tr.parent-row', function() {
      var actividadId = $(this).data('id');
      var childRow = $('#child-row-' + actividadId);

      // Alternar la visibilidad de la fila secundaria
      if (childRow.is(':hidden')) {
        $('.child-row').hide(); // Hide all other open child rows
        childRow.show();
      } else {
        childRow.hide();
      }
    });

    // Event listener for student links
    $(document).on('click', '.alumno-link', function() {
      let alumnoId = $(this).data('id');
      window.location.href = "/tareas-alumno/" + alumnoId;
    });
  });
</script>