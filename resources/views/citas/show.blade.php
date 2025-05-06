@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detalles de la Cita</h2>
    <p><strong>Paciente:</strong> {{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</p>
    <p><strong>DNI:</strong> {{ $cita->paciente->dni }}</p>
    <p><strong>Especialidad:</strong> {{ $cita->especialidad }}</p>
    <p><strong>Fecha:</strong> {{ $cita->fecha_cita }}</p>
    <p><strong>Hora:</strong> {{ $cita->hora_cita }}</p>
    <p><strong>Motivo:</strong> {{ $cita->motivo ?? 'No especificado' }}</p>

    <a href="{{ route('citas.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
