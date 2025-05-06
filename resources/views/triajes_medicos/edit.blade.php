@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Triaje Médico</h2>

    <form action="{{ route('triajes_medicos.update', $triaje->id) }}" method="POST">
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

        <div class="mb-3">
            <label for="diagnostico" class="form-label">Diagnóstico</label>
            <textarea name="diagnostico" class="form-control" rows="3" required>{{ $triaje->diagnostico }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tratamiento" class="form-label">Tratamiento</label>
            <textarea name="tratamiento" class="form-control" rows="2">{{ $triaje->tratamiento }}</textarea>
        </div>

        <div class="mb-3">
            <label for="receta" class="form-label">Receta</label>
            <textarea name="receta" class="form-control" rows="2">{{ $triaje->receta }}</textarea>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="2">{{ $triaje->observaciones }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Triaje Médico</button>
    </form>
</div>
@endsection
