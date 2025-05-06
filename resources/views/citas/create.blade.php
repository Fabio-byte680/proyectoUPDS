@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje6.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .registro-wrapper {
        background-color: rgba(255, 255, 255, 0.4);
        padding: 40px;
        border-radius: 15px;
        margin-top: 60px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    h2 {
        text-align: center;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 600;
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="registro-wrapper">

        <h2>Registrar Cita Médica</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Se encontraron algunos errores:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('citas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="paciente_id" class="form-label">Seleccionar Paciente</label>
                <select name="paciente_id" class="form-select" required>
                    <option value="">Seleccione un paciente</option>
                    @foreach ($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">
                            {{ $paciente->nombre }} {{ $paciente->apellido }} - DNI: {{ $paciente->dni }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad médica</label>
                <select name="especialidad" class="form-select" required>
                    <option value="">Seleccione</option>
                    <option value="Medicina General">Medicina General</option>
                    <option value="Pediatría">Pediatría</option>
                    <option value="Ginecología">Ginecología</option>
                    <option value="Cardiología">Cardiología</option>
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha_cita" class="form-label">Fecha de la cita</label>
                    <input type="date" name="fecha_cita" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="hora_cita" class="form-label">Hora de la cita</label>
                    <input type="time" name="hora_cita" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo de la consulta</label>
                <textarea name="motivo" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="acepta_politica" id="acepta_politica" required>
                <label class="form-check-label" for="acepta_politica">
                    Acepto la política de privacidad y el tratamiento de datos personales.
                </label>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-calendar-plus"></i> Registrar Cita
            </button>
        </form>

    </div>
</div>
@endsection
