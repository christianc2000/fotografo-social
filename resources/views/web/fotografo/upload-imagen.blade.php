@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Subir imagen</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('fotografo.upload.imagen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <label for="photo" class="form-label">Imagen</label>
                <div id="imagePreview"
                    style="display: flex; justify-content: center; align-items: center; max-width: 100%; max-height: 400px; width: 100%; height: 400px; border: 1px solid #ccc; background-color: #000000; overflow: hidden;">
                    <img id="preview" src="#" alt="Vista previa"
                        style="max-width: 100%; max-height: 100%; display: none;">
                    <span id="noImageText" style="display: block">Imagen
                        no
                        seleccionada</span>
                </div>
                <div class="mt-1">
                    <input type="file" class="form-control" name="photo" id="photo" accept=".jpeg, .jpg, .png">
                    <div id="photo" class="form-text">
                        @error('photo')
                            <div class="alert alert-danger form-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar Foto</button>
            </div>

        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
        // Función para mostrar la vista previa de la imagen seleccionada
        const inputPhoto = document.getElementById('photo');
        const previewImage = document.getElementById('preview');
        const noImageText = document.getElementById('noImageText');

        inputPhoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.style.display = 'block';
                    previewImage.src = event.target.result;
                    noImageText.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.style.display = 'none';
                noImageText.style.display = 'block';
            }
        });
    </script>
@stop
