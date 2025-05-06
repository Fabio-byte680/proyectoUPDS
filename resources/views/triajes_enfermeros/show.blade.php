@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalles del Triaje de Enfermería</h2>

    <div class="card">
        <div class="card-header">
            Paciente: {{ $triaje->paciente->nombre }} {{ $triaje->paciente->apellido }}
        </div>
        <div class="card-body">
            <p><strong>Temperatura:</strong> {{ $triaje->temperatura }} °C</p>
            <p><strong>Frecuencia Cardiaca:</strong> {{ $triaje->frecuencia_cardiaca }} lpm</p>
            <p><strong>Frecuencia Respiratoria:</strong> {{ $triaje->frecuencia_respiratoria }} rpm</p>
            <p><strong>Saturación de Oxígeno:</strong> {{ $triaje->saturacion_oxigeno }}%</p>
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
            <a href="{{ route('triajes_enfermeros.index') }}" class="btn btn-secondary">Volver a la lista</a>
            <a href="{{ route('triajes_enfermeros.edit', $triaje->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
