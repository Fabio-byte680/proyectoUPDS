@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detalles del Personal</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $personal->nombre }} {{ $personal->apellido }}</p>
            <p><strong>DNI:</strong> {{ $personal->dni }}</p>
            <p><strong>Cargo:</strong> {{ $personal->cargo }}</p>
            <p><strong>Especialidad:</strong> {{ $personal->especialidad ?? 'N/A' }}</p>
            <p><strong>Teléfono:</strong> {{ $personal->telefono ?? 'N/A' }}</p>
            <p><strong>Correo:</strong> {{ $personal->correo ?? 'N/A' }}</p>
        </div>
    </div>

    <a href="{{ route('personal.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
