@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Proyecto</h1>

    <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Proyecto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $proyecto->nombre) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Proyecto</button>
    </form>
</div>
@endsection
