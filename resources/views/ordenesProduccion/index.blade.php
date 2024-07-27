@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Órdenes de Producción para el Proyecto: {{ $proyecto->nombre }}</h1>

    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#createOrdenModal">Crear Orden de Producción</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordenesProduccion as $orden)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $orden->estado }}</td>
                    <td>
                        <a href="{{ route('muebles.index', $orden->id) }}" class="btn btn-info">Ver Muebles</a>
                        <!-- Otros botones para editar y borrar -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal para crear una nueva orden de producción -->
    <div class="modal fade" id="createOrdenModal" tabindex="-1" role="dialog" aria-labelledby="createOrdenModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('ordenesProduccion.store', $proyecto->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createOrdenModalLabel">Crear Orden de Producción</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" name="estado" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
