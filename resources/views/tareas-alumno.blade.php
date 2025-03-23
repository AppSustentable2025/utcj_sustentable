@extends('layouts.app2')
@section('content')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tareas de alumnos</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item">Tareas de alumnos</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $alumno->nombre }}</h5>
                        </div>
                        <!-- Tabla -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tarea</th>
                                    <th scope="col">Foto1</th>
                                    <th scope="col">Foto2</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alumno->tareas as $tarea)
                                <tr>
                                    <td>{{ $tarea->id }}</td>
                                    <td>{{ $tarea->nombre }}</td>
                                    <td>
                                        @if($tarea->pivot->imagen_1)
                                        <img src="{{ asset('storage/' . $tarea->pivot->imagen_1) }}" width="50">
                                        @else
                                        No disponible
                                        @endif
                                    </td>
                                    <td>
                                        @if($tarea->pivot->imagen_2)
                                        <img src="{{ asset('storage/' . $tarea->pivot->imagen_2) }}" width="50">
                                        @else
                                        No disponible
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!-- Fin Tabla -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- End #main -->
@endsection