@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje2.jpg'); /* Ruta de tu imagen */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .admin-panel {
        background-color: rgba(255, 255, 255, 0.3); /* Más transparencia */
        border-radius: 20px;
        padding: 40px 30px;
        margin-top: 50px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(5px); /* Difumina ligeramente el fondo */
    }

    .admin-header {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #222;
    }

    .admin-subtitle {
        font-size: 1.2rem;
        color: #444;
    }

    .admin-buttons {
        margin-top: 30px;
    }

    .admin-buttons .btn {
        min-width: 150px;
        padding: 12px 10px;
        font-size: 0.95rem;
        border-radius: 8px;
        text-align: center;
    }

    .admin-buttons i {
        font-size: 1.4rem;
        margin-right: 8px;
        vertical-align: middle;
    }

    .logout-section {
        margin-top: 40px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 admin-panel text-center">
            <h1 class="admin-header">Panel de Administración</h1>
            <p class="admin-subtitle">Bienvenido, Administrador. Selecciona una opción para comenzar.</p>

            <!-- Botones de navegación -->
            <div class="row admin-buttons justify-content-center">
                <div class="col-6 col-md-4 col-lg-3 mb-3">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-success w-100">
                        <i class="bi bi-person-plus"></i>Pacientes
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-3">
                    <a href="{{ route('personal.index') }}" class="btn btn-outline-success w-100">
                        <i class="bi bi-person-workspace"></i>Personal
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-3">
                    <a href="{{ route('triaje_enfermero.index') }}" class="btn btn-outline-info w-100">
                        <i class="bi bi-stethoscope"></i>Triaje Enfermero
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-3">
                    <a href="{{ route('triaje_medico.index') }}" class="btn btn-outline-info w-100">
                        <i class="bi bi-file-earmark-medical"></i>Triaje Médico
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3 mb-3">
                    <a href="{{ route('citas.index') }}" class="btn btn-outline-warning w-100">
                        <i class="bi bi-calendar-check"></i>Citas
                    </a>
                </div>
            </div>

            <!-- Cierre de sesión -->
            <div class="logout-section">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
