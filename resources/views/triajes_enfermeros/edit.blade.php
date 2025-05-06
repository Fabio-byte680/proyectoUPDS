@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Triaje de Enfermería</h2>

    <form action="{{ route('triajes_enfermeros.update', $triaje->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select class="form-select" name="paciente_id" required>
                <option value="">Seleccione un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ $paciente->id == $triaje->paciente_id ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="temperatura" class="form-label">Temperatura (°C)</label>
                <input type="number" step="0.1" name="temperatura" class="form-control" value="{{ $triaje->temperatura }}" required>
            </div>
            <div class="col-md-4">
                <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca (lpm)</label>
                <input type="number" name="frecuencia_cardiaca" class="form-control" value="{{ $triaje->frecuencia_cardiaca }}" required>
            </div>
            <div class="col-md-4">
                <label for="frecuencia_respiratoria" class="form-label">Frecuencia Respiratoria (rpm)</label>
                <input type="number" name="frecuencia_respiratoria" class="form-control" value="{{ $triaje->frecuencia_respiratoria }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="saturacion_oxigeno" class="form-label">Saturación de Oxígeno (%)</label>
            <input type="number" step="0.1" name="saturacion_oxigeno" class="form-control" value="{{ $triaje->saturacion_oxigeno }}" required>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3">{{ $triaje->observaciones }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Triaje</button>
    </form>
</div>
@endsection
