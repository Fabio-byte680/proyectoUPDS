@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje5.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-wrapper {
        background-color: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(5px);
        border-radius: 15px;
        padding: 40px;
        margin-top: 50px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    h2 {
        font-weight: bold;
        color: #2c3e50;
        text-align: center;
        margin-bottom: 30px;
    }

    .btn {
        border-radius: 8px;
    }

    .btn-primary {
        padding: 10px 20px;
        font-weight: 500;
    }

    .btn-secondary {
        padding: 10px 20px;
    }

    .form-label {
        font-weight: 500;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 form-wrapper">
            <h2>Registrar Nuevo Paciente</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pacientes.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" value="{{ old('dni') }}" required maxlength="20">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select name="sexo" id="sexo" class="form-select" required>
                            <option value="">Seleccione</option>
                            <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="otro" {{ old('sexo') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i> Registrar Paciente</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
