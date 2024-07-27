<style>
.card {
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: pointer;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card img {
    width: 100%;
    height: 200px; /* Adjust the height as needed */
    object-fit: cover; /* Ensures image fits the container without distortion */
}

.card-body {
    cursor: pointer;
}

.card-details {
    display: none;
    margin-top: 10px;
}

.card-details.show {
    display: block;
}

.back-button {
    position: absolute;
    top: 10px;
    right: 10px; /* Moved to the right */
    z-index: 1000;
}
.card-title-container {
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: box-shadow 0.2s, color 0.2s; /* Añadido para transición suave */
}

.card-title-container:hover {
    color: #007bff; /* Cambia el color del texto al pasar el puntero (opcional) */
}

.card-title-container .arrow {
    margin-left: 10px;
    transition: transform 0.3s, color 0.2s; /* Añadido para transición suave */
    opacity: 0; /* Inicialmente oculto */
}

.card-title-container:hover .arrow {
    transform: rotate(180deg);
    opacity: 1; /* Muestra la flecha al pasar el puntero */
}

.card-title-container .arrow::before {
    content: '⮟'; /* Utiliza el carácter de flecha hacia abajo */
    font-size: 16px; /* Ajusta el tamaño de la flecha según sea necesario */
}




</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-secondary back-button">← Volver</a>
    <h1><strong>PROYECTO: </strong>{{ $proyecto->nombre }}</h1>
    <h2><strong>EMPRESA: </strong>{{ $proyecto->empresa->nombre }}</h2>
    <h3><strong>MARCA: </strong>{{ $proyecto->marca->nombre }}</h3>

    <!-- <h2>ITEMS</h2> -->
    <br>
    <div class="row">
        @foreach($muebles as $mueble)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $mueble->image) }}" class="img-fluid" alt="Imagen del Mueble" data-toggle="modal" data-target="#imageModal" style="cursor: pointer;">
                    <div class="card-body">
                        <div class="card-title-container" onclick="toggleDetails({{ $mueble->id }})">
                            <h5 class="card-title">{{ $mueble->tipo_mueble }}</h5>
                            <i class="arrow fas fa-chevron-down"></i>
                        </div>

                        <div id="details-{{ $mueble->id }}" class="card-details card mt-3">
                <div class="card-body">
                    <p class="card-text">
                        <strong>Cantidad:</strong> {{ $mueble->cantidad_muebles }}<br>
                        <strong>Base:</strong> {{ $mueble->base }} mts<br>
                        <strong>Altura:</strong> {{ $mueble->altura }} mts<br>
                        <strong>Fondo:</strong> {{ $mueble->fondo }} mts<br>
                        <strong>Máquina:</strong> {{ $mueble->maquina }}<br>
                        <strong>Tipo de Impresión:</strong> {{ $mueble->tipo_impresion }}<br>
                        <strong>Acabado:</strong> {{ $mueble->acabado }}<br>
                        <strong>Nota:</strong> {{ $mueble->Nota }}<br>
                        <strong>País:</strong> {{ $mueble->Pais }}<br>
                    </p>
                </div>
            </div>
        </div>
                    <div class="card-footer text-muted d-flex justify-content-between">
                        <span>Añadido el {{ $mueble->created_at->format('d M Y') }}</span>
                        <div>
                            <!-- Botón Editar -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editMuebleModal{{ $mueble->id }}">
                                Editar
                            </button>

                            <!-- Botón Eliminar -->
                            <form action="{{ route('muebles.destroy', $mueble->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este mueble?');">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para Editar Mueble -->
                <div class="modal fade" id="editMuebleModal{{ $mueble->id }}" tabindex="-1" role="dialog" aria-labelledby="editMuebleModalLabel{{ $mueble->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <form action="{{ route('muebles.update', $mueble->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMuebleModalLabel{{ $mueble->id }}">Editar Mueble</h5>
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
                                                <input type="text" name="tipo_mueble" class="form-control" id="tipo_mueble" value="{{ old('tipo_mueble', $mueble->tipo_mueble) }}" required>
                                                @error('tipo_mueble')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cantidad_muebles">Cantidad de Muebles</label>
                                                <input type="number" name="cantidad_muebles" class="form-control" id="cantidad_muebles" value="{{ old('cantidad_muebles', $mueble->cantidad_muebles) }}" required>
                                                @error('cantidad_muebles')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="base">Base (mts)</label>
                                                <input type="number" name="base" class="form-control" id="base" value="{{ old('base', $mueble->base) }}" required>
                                                @error('base')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="altura">Altura (mts)</label>
                                                <input type="number" name="altura" class="form-control" id="altura" value="{{ old('altura', $mueble->altura) }}" required>
                                                @error('altura')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Columna 2 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fondo">Fondo (mts)</label>
                                                <input type="number" name="fondo" class="form-control" id="fondo" value="{{ old('fondo', $mueble->fondo) }}" required>
                                                @error('fondo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="maquina">Máquina</label>
                                                <input type="text" name="maquina" class="form-control" id="maquina" value="{{ old('maquina', $mueble->maquina) }}" required>
                                                @error('maquina')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tipo_impresion">Tipo de Impresión</label>
                                                <input type="text" name="tipo_impresion" class="form-control" id="tipo_impresion" value="{{ old('tipo_impresion', $mueble->tipo_impresion) }}" required>
                                                @error('tipo_impresion')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="acabado">Acabado</label>
                                                <input type="text" name="acabado" class="form-control" id="acabado" value="{{ old('acabado', $mueble->acabado) }}">
                                                @error('acabado')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Columna 3 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Nota">Nota</label>
                                                <textarea name="Nota" class="form-control" id="Nota">{{ old('Nota', $mueble->Nota) }}</textarea>
                                                @error('Nota')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="Pais">País</label>
                                                <input type="text" name="Pais" class="form-control" id="Pais" value="{{ old('Pais', $mueble->Pais) }}">
                                                @error('Pais')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Imagen</label>
                                                <input type="file" name="image" class="form-control-file" id="image">
                                                @if($mueble->image)
                                                    <br>
                                                    <img src="{{ asset('storage/' . $mueble->image) }}" class="img-fluid" alt="Imagen del Mueble">
                                                @endif
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
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

            </div>
        @endforeach
    </div>
</div>

<!-- Modal para ver la imagen en pantalla completa -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Imagen del Mueble</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="modalImage" class="img-fluid" alt="Imagen del Mueble">
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('img[data-target="#imageModal"]').forEach(img => {
        img.addEventListener('click', () => {
            document.getElementById('modalImage').src = img.src;
        });
    });

    function toggleDetails(id) {
        const details = document.getElementById(`details-${id}`);
        const arrow = details.previousElementSibling.querySelector('.arrow');

        if (details.style.display === 'none' || details.style.display === '') {
            details.style.display = 'block';
            arrow.classList.add('rotated');
        } else {
            details.style.display = 'none';
            arrow.classList.remove('rotated');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.card-details').forEach(details => {
            details.style.display = 'none';
        });
    });
</script>


<!-- Font Awesome for arrow icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha512-k6b7V+vDheBQyp3hC6d0D4a6VnM1RmA2L7efN1f6lqY8g+7/ssE2FpmkKNu4I4oy5mABcKkA5q6qf9os/4hV0Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
