@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Eliminar Registros</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <p class="text-center">Selecciona el módulo o el tipo de registro que deseas eliminar:</p>

    <!-- Botones para seleccionar módulo -->
    <div class="d-flex flex-wrap justify-content-center">
        <a href="{{ route('pacientes.index') }}" class="btn btn-outline-danger m-2">Pacientes</a>
        <a href="{{ route('personal.index') }}" class="btn btn-outline-danger m-2">Personal</a>
        <a href="{{ route('citas.index') }}" class="btn btn-outline-danger m-2">Citas</a>
        <a href="{{ route('especialidades.index') }}" class="btn btn-outline-danger m-2">Especialidades</a>
    </div>

    <!-- Formulario para eliminar registros -->
    <form action="{{ route('eliminar.destroy') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Registro</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="paciente">Paciente</option>
                <option value="personal">Personal</option>
                <option value="cita">Cita</option>
                <option value="especialidad">Especialidad</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="id" class="form-label">ID del Registro</label>
            <input type="number" name="id" id="id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <!-- Sección para la eliminación directa de registros -->
    <div class="row mt-4 justify-content-center">
        <!-- Eliminar Pacientes -->
        <div class="col-md-10 mb-3">
            <h4>Pacientes</h4>
            <a href="{{ route('pacientes.destroy', ['id' => 1]) }}" class="btn btn-danger m-2">Eliminar Paciente</a>
        </div>

        <!-- Eliminar Citas -->
        <div class="col-md-10 mb-3">
            <h4>Citas</h4>
            <a href="{{ route('citas.destroy', ['id' => 1]) }}" class="btn btn-danger m-2">Eliminar Cita</a>
        </div>

        <!-- Eliminar Personal -->
        <div class="col-md-10 mb-3">
            <h4>Personal</h4>
            <a href="{{ route('personal.destroy', ['id' => 1]) }}" class="btn btn-danger m-2">Eliminar Personal</a>
        </div>

        <!-- Eliminar Especialidades -->
        <div class="col-md-10 mb-3">
            <h4>Especialidades</h4>
            <a href="{{ route('especialidades.destroy', ['id' => 1]) }}" class="btn btn-danger m-2">Eliminar Especialidad</a>
        </div>
    </div>
</div>
@endsection
