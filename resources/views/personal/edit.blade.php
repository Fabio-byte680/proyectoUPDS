@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Personal</h2>

    <form action="{{ route('personal.update', $personal) }}" method="POST">
        @csrf
        @method('PUT')

        @include('personal.form', ['personal' => $personal])

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('personal.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
