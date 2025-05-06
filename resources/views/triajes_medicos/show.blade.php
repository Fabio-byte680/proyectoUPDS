@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del Triaje Médico</h2>

    <div class="card">
        <div class="card-header">
            Paciente: {{ $triaje->paciente->nombre }} {{ $triaje->paciente->apellido }}
        </div>
        <div class="card-body">
            <p><strong>Diagnóstico:</strong> {{ $triaje->diagnostico }}</p>
            <p><strong>Tratamiento:</strong> {{ $triaje->tratamiento ?? 'No disponible' }}</p>
            <p><strong>Receta:</strong> {{ $triaje->receta ?? 'No disponible' }}</p>
            <p><strong>Observaciones:</strong> {{ $triaje->observaciones ?? 'Ninguna' }}</p>
            <p><strong>Nivel de Riesgo:</strong> 
                <span class="badge bg-{{ [
                    'bajo' => 'success',
                    'moderado' => 'warning',
                    'alto' => 'danger',
                    'critico' => 'dark',
                ][$triaje->nivel_riesgo] }}">
                    {{ ucfirst($triaje->nivel_riesgo) }}
                </span>
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ route('triajes_medicos.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('triajes_medicos.edit', $triaje->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
