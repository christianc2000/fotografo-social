@extends('adminlte::page')
@section('title', 'Evento')

@section('content_header')
    <h1>Crear Evento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('evento.store') }}" method="POST" class="p-3" enctype="multipart/form-data"
                onsubmit="updateGpsValue()">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título:</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Dirección:</label>
                    <input type="text" id="address" name="address" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="gps" class="form-label">GPS:</label>

                    <input type="hidden" id="lati" value="-17.7821">
                    <input type="hidden" id="longi" value="-63.1748">

                    <div id="map" style="height: 400px; "> </div> <!-- Aquí irá el mapa de Google Maps -->
                    <input type="hidden" id="gps" name="gps">
                </div>
                <div class="mb-3">
                    <label for="event_date" class="form-label">Fecha del Evento:</label>
                    <input type="datetime-local" id="event_date" name="event_date" class="form-control">
                </div>

                <input type="hidden" id="organizador_id" name="organizador_id" class="form-control"
                    value="{{ Auth::user()->id }}">

                <div class="mb-3">
                    <label for="status" class="form-label">Estado:</label>
                    <select id="status" name="status" class="form-select">
                        <option value="1">Activo</option>
                        <option value="2">Cancelado</option>
                        <option value="3">Finalizado</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="img_event" class="form-label">Imagen del Evento:</label>
                    <input type="file" id="img_event" name="img_event" class="form-control"
                        onchange="previewImage(event)">
                    <div id="preview" class="d-flex justify-content-center mt-3">
                        <img id="preview-img" src="" alt="No seleccionó una imagen"
                            style="max-width: 300px; max-height: 300px; border: 1px solid #ccc; display: none;">
                        <div id="preview-text"
                            style="width: 300px; height: 300px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center;">
                            No seleccionó una imagen</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Crear Evento</button>
            </form>

        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log('Hi!');

        function initMap() {
            var lati = document.getElementById('lati').value;
            var longi = document.getElementById('longi').value;
            console.log(lati);
            if (lati != "") {

                const map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: parseFloat(lati),
                        lng: parseFloat(longi)
                    },
                    zoom: 13,
                });
                const marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(lati),
                        lng: parseFloat(longi)
                    },
                    map: map,
                    title: 'Ubicacion de Mercado el Quior',
                    draggable: true
                });

                // Agrega un evento 'dragend' al marcador para actualizar los campos de entrada cuando el marcador se mueva
                marker.addListener('dragend', function() {
                    document.getElementById('lati').value = marker.getPosition().lat();
                    document.getElementById('longi').value = marker.getPosition().lng();
                });

                var mensaje = document.getElementById('mensaje').style.display = "none";
            } else {
                var mensaje = document.getElementById('mensaje');
            }

        }
        window.initMap = initMap;
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAl8DaopxOLYwyY0gJV2fUky4_X99ZFwJY&callback=initMap" async
        defer></script>
    <script>
        function updateGpsValue() {
            var lati = document.getElementById('lati').value;
            var longi = document.getElementById('longi').value;
            document.getElementById('gps').value = lati + ',' + longi;
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var outputImg = document.getElementById('preview-img');
                var outputText = document.getElementById('preview-text');
                outputImg.src = reader.result;
                outputImg.style.display = 'block';
                outputText.style.display = 'none';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@stop
