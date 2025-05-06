@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje5.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .pacientes-container {
        background-color: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(5px);
        border-radius: 15px;
        padding: 40px;
        margin-top: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .titulo {
        font-size: 1.8rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .btn-sm {
        padding: 5px 12px;
        font-size: 0.85rem;
        margin-right: 4px;
    }

    .table th, .table td {
        vertical-align: middle !important;
        text-align: center;
    }

    .pagination {
        justify-content: center;
    }
</style>

<div class="container">
    <div class="pacientes-container">
        <h2 class="titulo text-center mb-4">Lista de Pacientes Registrados</h2>

        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Buscador -->
        <form action="{{ route('pacientes.index') }}" method="GET" class="row g-3 mb-4 justify-content-center">
            <div class="col-md-5">
                <input type="text" name="buscar" value="{{ $busqueda ?? '' }}" class="form-control" placeholder="Buscar por nombre, apellido, DNI o sexo">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('pacientes.index') }}" class="btn btn-secondary w-100"><i class="bi bi-x-circle"></i> Limpiar</a>
            </div>
        </form>

        <!-- Botón Registrar -->
        <div class="text-end mb-3">
            <a href="{{ route('pacientes.create') }}" class="btn btn-success">
                <i class="bi bi-person-plus-fill"></i> Registrar Nuevo Paciente
            </a>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>DNI</th>
                        <th>Sexo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->nombre }} {{ $paciente->apellido }}</td>
                            <td>{{ $paciente->dni }}</td>
                            <td>{{ ucfirst($paciente->sexo) }}</td>
                            <td>{{ $paciente->telefono }}</td>
                            <td>
                                <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Ver</a>
                                <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Editar</a>

                                <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" class="d-inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este paciente?')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No se encontraron pacientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $pacientes->appends(['buscar' => $busqueda])->links() }}
        </div>
    </div>
</div>
@endsection
