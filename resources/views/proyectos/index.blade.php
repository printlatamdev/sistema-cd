@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Proyectos</h1>
    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createProyectoModal">Crear Nuevo Proyecto</a>
    <table id="proyectosTable" class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Empresa</th>
            <th>Acciones</th>
            <th>Agregar Item/Mueble</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proyectos as $proyecto)
        <tr>
            <td>{{ $proyecto->id }}</td>
            <td>{{ $proyecto->nombre }}</td>
            <td>{{ $proyecto->marca ? $proyecto->marca->nombre : 'No disponible' }}</td>
            <td>{{ $proyecto->marca && $proyecto->marca->empresa ? $proyecto->marca->empresa->nombre : 'No disponible' }}</td>
            <td>
                <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto?');">Eliminar</button>
                </form>
            </td>
            <td>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMuebleModal{{ $proyecto->id }}">
                    Agregar Mueble
                </button>
            </td>
            <td>
                <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-primary">
                    Detalles
                </a>
            </td>
        </tr>

        <!-- Modal para agregar muebles -->
        <div class="modal fade" id="addMuebleModal{{ $proyecto->id }}" tabindex="-1" role="dialog" aria-labelledby="addMuebleModalLabel{{ $proyecto->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('muebles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addMuebleModalLabel{{ $proyecto->id }}">Agregar Mueble al Proyecto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Columna 1 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_mueble">Tipo de Mueble</label>
                                        <input type="text" class="form-control" name="tipo_mueble" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cantidad_muebles">Cantidad</label>
                                        <input type="number" class="form-control" name="cantidad_muebles" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="base">Base (mts)</label>
                                        <input type="number" step="0.01" class="form-control" name="base" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="acabado">Acabado</label>
                                        <input type="text" class="form-control" name="acabado">
                                    </div>
                                </div>
                                <!-- Columna 2 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="altura">Altura (mts)</label>
                                        <input type="number" step="0.01" class="form-control" name="altura" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fondo">Fondo (mts)</label>
                                        <input type="number" step="0.01" class="form-control" name="fondo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="maquina">Máquina</label>
                                        <input type="text" class="form-control" name="maquina" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Nota">Nota</label>
                                        <textarea class="form-control" name="Nota"></textarea>
                                    </div>
                                </div>
                                <!-- Columna 3 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_impresion">Tipo de Impresión</label>
                                        <input type="text" class="form-control" name="tipo_impresion" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Pais">Pais</label>
                                        <input type="text" class="form-control" name="Pais">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Imagen</label>
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Mueble</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </tbody>
</table>

    <!-- Modal para crear nuevo proyecto -->
<div class="modal fade" id="createProyectoModal" tabindex="-1" role="dialog" aria-labelledby="createProyectoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="createProyectoForm" action="{{ route('proyectos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createProyectoModalLabel">Crear Nuevo Proyecto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre del Proyecto</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="marca_id">Marca</label>
                        <select name="marca_id" class="form-control" required>
                            <option value="">Seleccionar Marca</option>
                            @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Crear Proyecto</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection


@push('scripts')
<script>
            $(document).ready(function() {
                $('#proyectosTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                    responsive: true
                });

                // Toggle Sidebar for small screens
                $('#sidebarToggle').click(function() {
                    $('#sidebar').toggleClass('show');
                    $('#content').toggleClass('shifted');
                });
            });
        </script>
@endpush
