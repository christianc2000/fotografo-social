@extends('adminlte::page')
@section('title', 'Evento')

@section('content_header')
    <div id="toastr-notifications"></div>
    <h1>Eventos Vinculados</h1>
@stop

@section('content')
    <div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 5%">ID</th>
                            <th scope="col" style="width: 25%">TITULO</th>
                            <th scope="col" style="width: 15%">DIRECCION</th>
                            <th scope="col" style="width: 15%">FECHA DEL EVENTO</th>
                            <th scope="col" style="width: 15%">FECHA ACEPTACION</th>
                            <th scope="col" style="width: 15%">QR</th>
                            <th scope="col" style="width: 10%">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $c = 1;
                        @endphp
                        @foreach ($eventos as $evento)
                            <tr style="height: 150px;" id={{ $evento->evento['id'] }}>
                                <td scope="row" style="width: 5%">{{ $evento->evento['id'] }}</td>
                                <td scope="row" style="width: 25%">{{ $evento->evento['title'] }}</td>
                                <td scope="row" style="width: 15%">{{ $evento->evento['address'] }}</td>
                                <td scope="row" style="width: 15%">{{ $evento->evento['event_date'] }}</td>
                                <td scope="row" style="width: 20%">{{ $evento->created_at }}</td>
                                <td scope="row" style="width: 20%">
                                    <img src="{{ $evento->qr_assistance }}" alt=""
                                        style="width: 200px; height: 200px; object-fit: contain;">
                                </td>

                                <td style="width: 15%">
                                    Opciones
                                </td>
                            </tr>

                            @php
                                $c++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
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
