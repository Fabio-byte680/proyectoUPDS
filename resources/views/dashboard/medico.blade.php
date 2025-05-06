@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Bienvenido Médico</h1>
    <p class="text-center">Aquí puedes gestionar tus triajes y consultar citas.</p>

    <div class="text-center mt-4">
        <a href="{{ route('triajes.index') }}" class="btn btn-primary m-2">Ver Triajes</a>
        <a href="{{ route('citas.index') }}" class="btn btn-success m-2">Ver Citas</a>
    </div>

    <!-- Formulario de cierre de sesión -->
    <div class="text-center mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>
</div>
@endsection
