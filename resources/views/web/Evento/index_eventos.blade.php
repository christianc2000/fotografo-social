@extends('adminlte::page')
@section('title', 'Evento')

@section('content_header')
    <div id="toastr-notifications"></div>
    <h1>Eventos</h1>
@stop

@section('content')
    <div>

        {{-- <div class="mb-3">
                <a href="{{ route('evento.create') }}" class="btn btn-primary">Crear Evento</a>
            </div> --}}
        <div class="container text-center">
            <div class="row align-items-end">
                @foreach ($eventos as $evento)
                    <div class="col-3 mb-3">
                        <div style="width: 100%; position: relative;">
                            <img src="{{ $evento->img_event }}" alt="Imagen Subida"
                                style=" width: 100%;
                                        height: 300px;
                                        object-fit: none;">
                            <div class="overlay">
                                <p class="text">{{ $evento->title }}</p>
                            </div>
                         
                        </div>
                        <div style="height: 100px; background: #FFE981; display: flex; flex-direction: row; align-items: center;">
                            <span style="height: 100%; width: 33%; background: green; display: flex; justify-content: center; align-items: center;">Activo</span>
                            <div style="width: 33%; display: flex">
                                <button class="btn btn-success">Ver</button>
                            </div>
                            <div style="width: 33%; display: flex">
                                <button class="btn btn-success">Galeria</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 30px;
            /* Altura fija del overlay */
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .text {
            color: white;
            font-size: 12px;
            text-align: center;
            margin: 0;
            /* Eliminar margen interno del párrafo */
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {

        });
    </script>
@stop
