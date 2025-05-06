<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $paciente->nombre) }}" required>
</div>

<div class="mb-3">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $paciente->apellido) }}" required>
</div>

<div class="mb-3">
    <label for="dni" class="form-label">DNI</label>
    <input type="text" name="dni" class="form-control" value="{{ old('dni', $paciente->dni) }}" required>
</div>

<div class="mb-3">
    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>
</div>

<div class="mb-3">
    <label for="sexo" class="form-label">Sexo</label>
    <select name="sexo" class="form-select" required>
        <option value="">Seleccione...</option>
        <option value="masculino" {{ old('sexo', $paciente->sexo) == 'masculino' ? 'selected' : '' }}>Masculino</option>
        <option value="femenino" {{ old('sexo', $paciente->sexo) == 'femenino' ? 'selected' : '' }}>Femenino</option>
        <option value="otro" {{ old('sexo', $paciente->sexo) == 'otro' ? 'selected' : '' }}>Otro</option>
    </select>
</div>

<div class="mb-3">
    <label for="direccion" class="form-label">Dirección</label>
    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion) }}">
</div>

<div class="mb-3">
    <label for="telefono" class="form-label">Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}">
</div>

<div class="mb-3">
    <label for="correo" class="form-label">Correo</label>
    <input type="email" name="correo" class="form-control" value="{{ old('correo', $paciente->correo) }}">
</div>
