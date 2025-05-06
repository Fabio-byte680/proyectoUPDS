<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $personal->nombre ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $personal->apellido ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="dni" class="form-label">DNI</label>
    <input type="text" name="dni" class="form-control" value="{{ old('dni', $personal->dni ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="cargo" class="form-label">Cargo</label>
    <input type="text" name="cargo" class="form-control" value="{{ old('cargo', $personal->cargo ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="especialidad" class="form-label">Especialidad</label>
    <input type="text" name="especialidad" class="form-control" value="{{ old('especialidad', $personal->especialidad ?? '') }}">
</div>

<div class="mb-3">
    <label for="telefono" class="form-label">Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $personal->telefono ?? '') }}">
</div>

<div class="mb-3">
    <label for="correo" class="form-label">Correo</label>
    <input type="email" name="correo" class="form-control" value="{{ old('correo', $personal->correo ?? '') }}">
</div>
