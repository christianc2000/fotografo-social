@extends('adminlte::page')
@section('title', 'Evento')

@section('content_header')
    <div id="toastr-notifications"></div>
    <h1>Clientes vinculado al evento {{$evento->title}}</h1>
@stop

@section('content')
    <div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 5%">ID</th>
                            <th scope="col" style="width: 25%">NOMBRE</th>
                            <th scope="col" style="width: 15%">EMAIL</th>
                            <th scope="col" style="width: 15%">CELULAR</th>
                            <th scope="col" style="width: 15%">FECHA ACEPTACION</th>
                            <th scope="col" style="width: 20%">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $c = 1;
                        @endphp
                        @foreach ($evento->vinculacionClientes as $vc)
                            <tr style="height: 150px;" id={{ $vc->cliente->user['id'] }}>
                                <td scope="row" style="width: 5%">{{  $vc->cliente->user['id']  }}</td>
                                <td scope="row" style="width: 25%">{{ $vc->cliente->user['name'] }} {{$vc->cliente->user['lastname'] }}</td>
                                <td scope="row" style="width: 15%">{{ $vc->cliente->user['email'] }}</td>
                                <td scope="row" style="width: 15%">{{ $vc->cliente->user['number_phone'] }}</td>
                                <td scope="row" style="width: 20%">{{ $vc->accept_date }}</td>
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
