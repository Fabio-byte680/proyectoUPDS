@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje4.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container {
        background-color: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(4px);
        border-radius: 15px;
        padding: 40px;
        margin-top: 50px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .form-title {
        font-size: 1.9rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-success {
        padding: 10px 24px;
        font-size: 1rem;
        border-radius: 8px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 form-container">
            <h2 class="form-title text-center">Registrar Triaje Médico</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('triajes_medicos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="paciente_id" class="form-label">Paciente</label>
                    <select class="form-select" name="paciente_id" required>
                        <option value="">Seleccione un paciente</option>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="diagnostico" class="form-label">Diagnóstico</label>
                    <textarea name="diagnostico" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="tratamiento" class="form-label">Tratamiento</label>
                    <textarea name="tratamiento" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label for="receta" class="form-label">Receta</label>
                    <textarea name="receta" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-4">
                    <label for="nivel_riesgo" class="form-label">Nivel de Riesgo</label>
                    <select name="nivel_riesgo" class="form-select" required>
                        <option value="bajo">Bajo</option>
                        <option value="moderado">Moderado</option>
                        <option value="alto">Alto</option>
                        <option value="critico">Crítico</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Guardar Triaje Médico
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
