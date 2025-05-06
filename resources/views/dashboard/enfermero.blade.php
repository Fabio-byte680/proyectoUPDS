@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Bienvenido Enfermero(a)</h1>
    <p class="text-center">Aquí puedes registrar triajes y atender a los pacientes.</p>

    <div class="text-center mt-4">
        <a href="{{ route('triajes.create') }}" class="btn btn-primary m-2">Registrar Triaje</a>
        <a href="{{ route('pacientes.index') }}" class="btn btn-info m-2">Ver Pacientes</a>
    </div>
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
