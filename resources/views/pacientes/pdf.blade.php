<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha del Paciente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h1, h3 {
            text-align: center;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
        }
        .date {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- Header Section with Logo and Date -->
    <div class="header">
        <div class="logo">
            <!-- Add your logo image here -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 100%; height: auto;">
        </div>
        <div class="date">
            <strong>Fecha de Generación:</strong> {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>

    <h1>Ficha del Paciente</h1>

    <table>
        <tr>
            <th align="left">Nombre</th>
            <td>{{ $paciente->nombre }} {{ $paciente->apellido }}</td>
        </tr>
        <tr>
            <th align="left">DNI</th>
            <td>{{ $paciente->dni }}</td>
        </tr>
        <tr>
            <th align="left">Fecha de Nacimiento</th>
            <td>{{ $paciente->fecha_nacimiento }}</td>
        </tr>
        <tr>
            <th align="left">Sexo</th>
            <td>{{ ucfirst($paciente->sexo) }}</td>
        </tr>
        <tr>
            <th align="left">Dirección</th>
            <td>{{ $paciente->direccion }}</td>
        </tr>
        <tr>
            <th align="left">Teléfono</th>
            <td>{{ $paciente->telefono }}</td>
        </tr>
        <tr>
            <th align="left">Correo</th>
            <td>{{ $paciente->correo }}</td>
        </tr>
        <tr>
            <th align="left">Estado</th>
            <td>{{ $paciente->estado }}</td>
        </tr>
    </table>

    <br><br>

    <h3>Historial de Citas Médicas</h3>
    @if ($paciente->citas->isEmpty())
        <p>No hay citas registradas.</p>
    @else
        <table>
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

    <br><br>

    <h3>Historial de Triajes</h3>
    @if ($paciente->triajes->count())
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paciente->triajes as $triaje)
                    <tr>
                        <td>{{ $triaje->fecha ?? $triaje->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $triaje->enfermera->nombre ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay triajes registrados.</p>
    @endif

</body>
</html>
