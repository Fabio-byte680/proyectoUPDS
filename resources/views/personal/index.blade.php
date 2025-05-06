@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje7.jpg'); /* Asegúrate de que esta ruta sea correcta */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .personal-wrapper {
        background-color: rgba(255, 255, 255, 0.4);
        padding: 40px;
        border-radius: 15px;
        margin-top: 60px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    h2 {
        text-align: center;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px;
    }

    .btn-primary {
        font-weight: 600;
    }

    .table th, .table td {
        text-align: center;
    }

    .table th {
        background-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .alert {
        border-radius: 10px;
        font-size: 14px;
    }
</style>

<div class="container">
    <div class="personal-wrapper">

        <h2>Lista de Personal</h2>

        {{-- Formulario de búsqueda --}}
        <form action="{{ route('personal.index') }}" method="GET" class="d-flex mb-4">
            <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar por nombre o cargo" value="{{ request('buscar') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        {{-- Botón para registrar nuevo personal --}}
        <a href="{{ route('personal.create') }}" class="btn btn-success mb-3">Registrar Nuevo Personal</a>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Tabla de personal --}}
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Cargo</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($personal as $persona)
                    <tr>
                        <td>{{ $persona->nombre }} {{ $persona->apellido }}</td>
                        <td>{{ $persona->cargo }}</td>
                        <td>{{ $persona->especialidad ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('personal.show', $persona) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('personal.edit', $persona) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('personal.destroy', $persona) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">No se encontraron registros.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center">
            {{ $personal->links() }}
        </div>
    </div>
</div>
@endsection
