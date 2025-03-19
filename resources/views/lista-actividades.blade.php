@extends('layouts.app2')
@section('content')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


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
            <table id="actividadTable" class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Periodo</th>
                  <th scope="col">Horario</th>
                </tr>
              </thead>
              <tbody>
                @foreach($actividades as $actividad)
                <tr>
                  <td><a href="#">{{ $actividad->id }}</a></td>
                  <td>{{ $actividad->Periodo }}</td>
                  <td>{{ $actividad->Horario }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main>
<!-- End #main -->
@endsection

<!-- Cargar DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

