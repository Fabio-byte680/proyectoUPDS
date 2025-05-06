@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/triaje9.jpeg'); /* Asegúrate de tener esta imagen en public/images */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 16px;
    }

    .table, .list-group-item {
        background-color: rgba(255, 255, 255, 0.4);
    }
</style>

<div class="container mt-5">
    <h2><i class="bi bi-person-badge-fill"></i> Detalles del Paciente</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

    <div class="card shadow rounded-4 p-4">
        <div class="card-body">
            <div class="row">
                <!-- Foto de perfil -->
                <div class="col-md-4 text-center">
                    @if ($paciente->foto)
                        <img src="{{ asset('storage/fotos/' . $paciente->foto) }}" alt="Foto de Perfil" class="img-fluid rounded-circle border border-3 shadow mb-3" style="width: 300px; height: 300px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Foto por defecto" class="img-fluid rounded-circle border mb-3" style="width: 300px; height: 300px; object-fit: cover;">
                        <p class="text-muted">No hay foto de perfil</p>
                    @endif
                </div>

                <!-- Datos -->
                <div class="col-md-8">
                    <p><strong>Nombre:</strong> {{ $paciente->nombre }} {{ $paciente->apellido }}</p>
                    <p><strong>DNI:</strong> {{ $paciente->dni }}</p>
                    <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
                    <p><strong>Sexo:</strong> {{ ucfirst($paciente->sexo) }}</p>
                    <p><strong>Dirección:</strong> {{ $paciente->direccion }}</p>
                    <p><strong>Teléfono:</strong> {{ $paciente->telefono }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $paciente->correo }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge bg-{{ $paciente->estado == 'Activo' ? 'success' : 'secondary' }}">
                            {{ $paciente->estado }}
                        </span>
                    </p>

                    <a href="{{ route('pacientes.exportarPDF', $paciente->id) }}" class="btn btn-outline-dark mt-2">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Descargar Ficha en PDF
                    </a>
                </div>
            </div>

            <!-- Subir nueva foto -->
            <form action="{{ route('pacientes.subirFoto', $paciente->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="foto" class="form-label"><i class="bi bi-upload"></i> Subir Nueva Foto de Perfil</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Guardar Foto</button>
            </form>

            <!-- Sección de triajes -->
            <div class="text-center mt-5">
                <h4 class="fw-bold text-primary">Registro de Atenciones Médicas y de Enfermería</h4>
            </div>

            <!-- Triajes de Enfermería -->
            <h5 class="mt-4"><i class="bi bi-clipboard2-heart-fill"></i> Triajes de Enfermería</h5>
            @if($paciente->triajesEnfermeros && $paciente->triajesEnfermeros->count())
                <ul class="list-group">
                    @foreach($paciente->triajesEnfermeros as $triaje)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Fecha:</strong> {{ $triaje->created_at->format('d/m/Y H:i') }} |
                                <strong>Nivel de Riesgo:</strong>
                                <span class="badge bg-{{ [
                                    'bajo' => 'success',
                                    'moderado' => 'warning',
                                    'alto' => 'danger',
                                    'critico' => 'dark',
                                ][$triaje->nivel_riesgo] ?? 'secondary' }}">
                                    {{ ucfirst($triaje->nivel_riesgo) }}
                                </span>
                            </div>
                            <a href="{{ route('triajes_enfermeros.show', $triaje->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye-fill"></i> Ver
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay registros de triajes de enfermería.</p>
            @endif

            <!-- Triajes Médicos -->
            <h5 class="mt-4"><i class="bi bi-clipboard2-pulse-fill"></i> Triajes Médicos</h5>
            @if($paciente->triajesMedicos && $paciente->triajesMedicos->count())
                <ul class="list-group">
                    @foreach($paciente->triajesMedicos as $triaje)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Fecha:</strong> {{ $triaje->created_at->format('d/m/Y H:i') }} |
                                <strong>Diagnóstico:</strong> {{ $triaje->diagnostico }}
                            </div>
                            <a href="{{ route('triajes_medicos.show', $triaje->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye-fill"></i> Ver
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No hay registros de triajes médicos.</p>
            @endif

            <!-- Historial de citas -->
            <h5 class="mt-4"><i class="bi bi-calendar-check-fill"></i> Historial de Citas Médicas</h5>
            @if ($paciente->citas->isEmpty())
                <p class="text-muted">No se han registrado citas médicas.</p>
            @else
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Especialidad</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paciente->citas as $cita)
                            <tr>
                                <td>{{ $cita->fecha_cita }}</td>
                                <td>{{ $cita->hora_cita }}</td>
                                <td>{{ $cita->especialidad }}</td>
                                <td>{{ $cita->motivo ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left-circle"></i> Volver a la lista
    </a>
</div>
@endsection
