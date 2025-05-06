@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Bienvenida Secretaria</h1>
    <p class="text-center">Aquí puedes registrar pacientes y programar citas.</p>

    <div class="text-center mt-4">
        <a href="{{ route('pacientes.create') }}" class="btn btn-success m-2">Registrar Paciente</a>
        <a href="{{ route('citas.create') }}" class="btn btn-primary m-2">Programar Cita</a>
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
