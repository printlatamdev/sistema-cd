@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Empresas</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table id="empresasTable" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th width="280px">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empresas as $empresa)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $empresa->nombre }}</td>
            <td>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editEmpresaModal{{ $empresa->id }}">Editar</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteEmpresaModal{{ $empresa->id }}">Borrar</button>
            </td>
        </tr>

        <!-- Modal para editar empresa -->
        <div class="modal fade" id="editEmpresaModal{{ $empresa->id }}" tabindex="-1" role="dialog" aria-labelledby="editEmpresaModalLabel{{ $empresa->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEmpresaModalLabel{{ $empresa->id }}">Editar Empresa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="{{ $empresa->nombre }}" required>
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

        <!-- Modal para borrar empresa -->
        <div class="modal fade" id="deleteEmpresaModal{{ $empresa->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteEmpresaModalLabel{{ $empresa->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteEmpresaModalLabel{{ $empresa->id }}">Borrar Empresa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas borrar esta empresa?</p>
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

<!-- Modal para crear nueva empresa -->
<div class="modal fade" id="createEmpresaModal" tabindex="-1" role="dialog" aria-labelledby="createEmpresaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('empresas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createEmpresaModalLabel">Crear Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
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
<button type="button" class="btn btn-success btn-floating" data-toggle="modal" data-target="#createEmpresaModal">
<i class="fas fa-magic"></i>
</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
$(document).ready(function() {
    $('#empresasTable').DataTable({
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
