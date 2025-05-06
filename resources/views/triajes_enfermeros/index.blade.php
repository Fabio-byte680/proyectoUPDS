@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje3.png'); /* Ruta de tu imagen */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .triaje-container {
        background-color: rgba(255, 255, 255, 0.4); /* Fondo translúcido */
        border-radius: 15px;
        padding: 30px;
        margin-top: 40px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(4px);
    }

    .triaje-header {
        font-size: 1.8rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .new-triaje-btn {
        margin-bottom: 20px;
    }

    table th, table td {
        vertical-align: middle !important;
        text-align: center;
    }
</style>

<div class="container">
    <div class="triaje-container">
        <h2 class="triaje-header text-center">Listado de Triajes de Enfermería</h2>

        <div class="text-end new-triaje-btn">
            <a href="{{ route('triajes_enfermeros.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Nuevo Triaje
            </a>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Paciente</th>
                    <th>Temperatura</th>
                    <th>F. Cardíaca</th>
                    <th>F. Respiratoria</th>
                    <th>Saturación O₂</th>
                    <th>Nivel de Riesgo</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($triajes as $triaje)
                    <tr>
                        <td>
                            @if($triaje->paciente)
                                {{ $triaje->paciente->nombre }} {{ $triaje->paciente->apellido }}
                            @else
                                <span class="text-muted">Paciente eliminado</span>
                            @endif
                        </td>
                        <td>{{ $triaje->temperatura ?? '—' }} °C</td>
                        <td>{{ $triaje->frecuencia_cardiaca ?? '—' }}</td>
                        <td>{{ $triaje->frecuencia_respiratoria ?? '—' }}</td>
                        <td>{{ $triaje->saturacion_oxigeno ?? '—' }}%</td>
                        <td>
                            @php
                                $colores = [
                                    'bajo' => 'success',
                                    'moderado' => 'warning',
                                    'alto' => 'danger',
                                    'critico' => 'dark',
                                ];
                            @endphp
                            <span class="badge bg-{{ $colores[$triaje->nivel_riesgo] ?? 'secondary' }}">
                                {{ ucfirst($triaje->nivel_riesgo ?? 'No clasificado') }}
                            </span>
                        </td>
                        <td>{{ $triaje->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay registros de triajes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
