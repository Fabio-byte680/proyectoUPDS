@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje4.jpg'); /* Cambia según tu imagen */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .triaje-container {
        background-color: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(5px);
        border-radius: 15px;
        padding: 40px;
        margin-top: 50px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .triaje-title {
        font-size: 1.9rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 25px;
    }

    .btn-success {
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 8px;
    }

    .table th, .table td {
        vertical-align: middle !important;
        text-align: center;
    }
</style>

<div class="container">
    <div class="triaje-container">
        <h2 class="triaje-title text-center">Listado de Triajes Médicos</h2>

        <div class="text-end mb-3">
            <a href="{{ route('triajes_medicos.create') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle"></i> Nuevo Triaje Médico
            </a>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-success">
                <tr>
                    <th>Paciente</th>
                    <th>Diagnóstico</th>
                    <th>Tratamiento</th>
                    <th>Nivel de Riesgo</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($triajes as $triaje)
                    <tr>
                        <td>{{ $triaje->paciente->nombre }} {{ $triaje->paciente->apellido }}</td>
                        <td>{{ $triaje->diagnostico }}</td>
                        <td>{{ $triaje->tratamiento }}</td>
                        <td>
                            <span class="badge bg-{{ [
                                'bajo' => 'success',
                                'moderado' => 'warning',
                                'alto' => 'danger',
                                'critico' => 'dark',
                            ][$triaje->nivel_riesgo] ?? 'secondary' }}">
                                {{ ucfirst($triaje->nivel_riesgo) }}
                            </span>
                        </td>
                        <td>{{ $triaje->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay registros de triajes médicos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
