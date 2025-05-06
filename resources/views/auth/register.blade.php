@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje8.jpg'); /* Asegúrate de que esta imagen exista */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .register-wrapper {
        background-color: rgba(255, 255, 255, 0.4);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .form-label {
        font-weight: 600;
    }

    .register-title {
        text-align: center;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="register-wrapper">
                <h4 class="register-title">Registro de Nuevo Usuario</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre_completo" class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre_completo" class="form-control" id="nombre_completo" required value="{{ old('nombre_completo') }}">
                    </div>

                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="nombre_usuario" class="form-control" id="nombre_usuario" required value="{{ old('nombre_usuario') }}">
                    </div>

                    <div class="mb-3">
                        <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" class="form-control" id="correo_electronico" required value="{{ old('correo_electronico') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol de Usuario</label>
                        <select name="rol" id="rol" class="form-select" required>
                            <option value="">Seleccione un rol</option>
                            <option value="administrador">Administrador</option>
                            <option value="medico">Médico</option>
                            <option value="enfermero">Enfermero</option>
                            <option value="secretaria">Secretaria</option>
                            <option value="coordinador">Coordinador</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">¿Ya tienes una cuenta? Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
