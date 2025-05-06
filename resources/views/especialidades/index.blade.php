@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Especialidades Médicas</h2>
    <a href="{{ route('especialidades.create') }}" class="btn btn-success mb-3">Agregar Especialidad</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($especialidades as $especialidad)
                <tr>
                    <td>{{ $especialidad->nombre }}</td>
                    <td>{{ $especialidad->descripcion }}</td>
                    <td>
                        <a href="{{ route('especialidades.edit', $especialidad) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('especialidades.destroy', $especialidad) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta especialidad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
