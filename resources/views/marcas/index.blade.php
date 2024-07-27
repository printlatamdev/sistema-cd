@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Marcas</h2>
        </div>
    </div>
</div>

<!-- Mostrar mensajes de éxito o error -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<table id="marcasTable" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Empresa</th>
            <th width="280px">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($marcas as $marca)
        <tr id="marcaRow{{ $marca->id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $marca->nombre }}</td>
            <td>{{ $marca->empresa->nombre }}</td>
            <td>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editMarcaModal{{ $marca->id }}">Editar</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteMarcaModal{{ $marca->id }}">Borrar</button>
            </td>
        </tr>

        <!-- Modal para editar marca -->
        <div class="modal fade" id="editMarcaModal{{ $marca->id }}" tabindex="-1" role="dialog" aria-labelledby="editMarcaModalLabel{{ $marca->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="editMarcaForm{{ $marca->id }}" action="{{ route('marcas.update', $marca->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMarcaModalLabel{{ $marca->id }}">Editar Marca</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="{{ $marca->nombre }}" required>
                            </div>
                            <div class="form-group">
                                <label for="empresa_id">Empresa</label>
                                <select name="empresa_id" class="form-control" required>
                                    @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}" {{ $empresa->id == $marca->empresa_id ? 'selected' : '' }}>{{ $empresa->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para borrar marca -->
        <div class="modal fade" id="deleteMarcaModal{{ $marca->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteMarcaModalLabel{{ $marca->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="deleteMarcaForm{{ $marca->id }}" action="{{ route('marcas.destroy', $marca->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteMarcaModalLabel{{ $marca->id }}">Borrar Marca</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas borrar esta marca?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </tbody>
</table>

<!-- Modal para crear nueva marca -->
<div class="modal fade" id="createMarcaModal" tabindex="-1" role="dialog" aria-labelledby="createMarcaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="createMarcaForm" action="{{ route('marcas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createMarcaModalLabel">Crear Marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="empresa_id">Empresa</label>
                        <select name="empresa_id" class="form-control" required>
                            <option value="">Seleccionar Empresa</option>
                            @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
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

<!-- Botón flotante con ícono de varita mágica -->
<button type="button" class="btn btn-success btn-floating" data-toggle="modal" data-target="#createMarcaModal">
    <i class="fas fa-magic"></i>
</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
$(document).ready(function() {
    $('#marcasTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        }
    });
});
</script>

<style>
.btn-floating {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    font-size: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

.btn-floating i {
    color: #fff;
}
</style>
@endsection
