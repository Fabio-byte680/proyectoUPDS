@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje3.png');
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
        font-size: 1.8rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 500;
        color: #444;
    }

    .btn-primary {
        padding: 10px 20px;
        font-size: 1rem;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 form-container">
            <h2 class="form-title text-center">Registrar Triaje de Enfermería</h2>

            <form action="{{ route('triajes_enfermeros.store') }}" method="POST">
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

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="temperatura" class="form-label">Temperatura (°C)</label>
                        <input type="number" step="0.1" name="temperatura" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca (lpm)</label>
                        <input type="number" name="frecuencia_cardiaca" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="frecuencia_respiratoria" class="form-label">Frecuencia Respiratoria (rpm)</label>
                        <input type="number" name="frecuencia_respiratoria" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="saturacion_oxigeno" class="form-label">Saturación de Oxígeno (%)</label>
                    <input type="number" step="0.1" name="saturacion_oxigeno" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Triaje
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
