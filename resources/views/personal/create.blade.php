@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje7.jpg'); /* Asegúrate de que la imagen exista en public/images */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .form-wrapper {
        background-color: rgba(255, 255, 255, 0.4);
        padding: 40px;
        border-radius: 15px;
        margin-top: 60px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    h2 {
        text-align: center;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px;
    }

    .btn {
        min-width: 120px;
    }
</style>

<div class="container">
    <div class="form-wrapper">
        <h2>Registrar Personal</h2>

        <form action="{{ route('personal.store') }}" method="POST">
            @csrf

            {{-- Formulario reutilizable --}}
            @include('personal.form')

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('personal.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
