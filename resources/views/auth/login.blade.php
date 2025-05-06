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

    .login-wrapper {
        background-color: rgba(255, 255, 255, 0.4);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .login-title {
        text-align: center;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
    }

    .btn-success {
        font-weight: bold;
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
        <div class="col-md-5">
            <div class="login-wrapper">
                <h4 class="login-title">Iniciar Sesión</h4>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Ingresar</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('register') }}">¿No tienes una cuenta? Registrarse</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
