@extends('layouts.app2')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Lista de alumnos</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Lista de alumnos</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('actividades.create') }}" class="btn btn-primary btn-sm px-4">Nuevo</a>
                        </div>

                        <!-- Tabla -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Matrícula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Creado</th>
                                </tr>                            
                            </thead>
                            <tbody>
                                @foreach($alumnos as $alumno)
                                    <tr>
                                        <td>{{ $alumno->id }}</td>
                                        <td>{{ $alumno->matricula }}</td>
                                        <td>{{ $alumno->nombre }}</td>
                                        <td>{{ $alumno->created_at }}</td>
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

@endsection
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>



