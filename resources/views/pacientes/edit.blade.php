@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Paciente</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $paciente->nombre) }}">
        </div>
        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $paciente->apellido) }}">
        </div>
        <div class="mb-3">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control" value="{{ old('dni', $paciente->dni) }}">
        </div>
        <div class="mb-3">
            <label>Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}">
        </div>
        <div class="mb-3">
            <label>Sexo</label>
            <select name="sexo" class="form-control">
                <option value="masculino" {{ $paciente->sexo == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ $paciente->sexo == 'femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="otro" {{ $paciente->sexo == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion) }}">
        </div>
        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}">
        </div>
        <div class="mb-3">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo', $paciente->correo) }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
