@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje6.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .cita-wrapper {
        background-color: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(4px);
        border-radius: 15px;
        padding: 40px;
        margin-top: 50px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    h2 {
        font-weight: bold;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
    }

    .btn {
        border-radius: 6px;
        padding: 8px 15px;
        font-weight: 500;
    }

    .table th {
        background-color: #198754;
        color: white;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
    }
</style>

<div class="container">
    <div class="cita-wrapper">

        <h2>Listado de Citas Médicas</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        {{-- Formulario de búsqueda --}}
        <form action="{{ route('citas.index') }}" method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-6">
                <label for="buscar" class="form-label">Buscar</label>
                <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Motivo o especialidad" value="{{ $busqueda }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Buscar</button>
            </div>
            <div class="col-md-3 text-end">
                <a href="{{ route('citas.create') }}" class="btn btn-success w-100"><i class="bi bi-calendar-plus"></i> Nueva Cita</a>
            </div>
        </form>

        {{-- Tabla de citas --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Especialidad</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Motivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($citas as $cita)
                        <tr>
                            <td>{{ $cita->id }}</td>
                            <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
                            <td>{{ $cita->especialidad }}</td>
                            <td>{{ $cita->fecha_cita }}</td>
                            <td>{{ $cita->hora_cita }}</td>
                            <td>{{ $cita->motivo ?? '—' }}</td>
                            <td>
                                <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-sm btn-info mb-1"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Deseas eliminar esta cita?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No se encontraron citas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $citas->links() }}
        </div>
    </div>
</div>
@endsection
