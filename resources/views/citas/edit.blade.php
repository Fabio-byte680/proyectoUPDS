@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Cita Médica</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Se encontraron algunos errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de edición --}}
    <form action="{{ route('citas.update', $cita->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Selección del paciente --}}
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Seleccionar Paciente</label>
            <select name="paciente_id" class="form-select" required>
                <option value="">Seleccione un paciente</option>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ $cita->paciente_id == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellido }} - DNI: {{ $paciente->dni }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Detalles de la cita --}}
        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad médica</label>
            <select name="especialidad" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="Medicina General" {{ $cita->especialidad == 'Medicina General' ? 'selected' : '' }}>Medicina General</option>
                <option value="Pediatría" {{ $cita->especialidad == 'Pediatría' ? 'selected' : '' }}>Pediatría</option>
                <option value="Ginecología" {{ $cita->especialidad == 'Ginecología' ? 'selected' : '' }}>Ginecología</option>
                <option value="Cardiología" {{ $cita->especialidad == 'Cardiología' ? 'selected' : '' }}>Cardiología</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_cita" class="form-label">Fecha de la cita</label>
            <input type="date" name="fecha_cita" class="form-control" value="{{ $cita->fecha_cita }}" required>
        </div>

        <div class="mb-3">
            <label for="hora_cita" class="form-label">Hora de la cita</label>
            <input type="time" name="hora_cita" class="form-control" value="{{ $cita->hora_cita }}" required>
        </div>

        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo de la consulta</label>
            <textarea name="motivo" class="form-control" rows="3">{{ $cita->motivo }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Cita</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    {{-- Botón para eliminar la cita --}}
    <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">
            Eliminar Cita
        </button>
    </form>
</div>
@endsection
