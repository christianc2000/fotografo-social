@extends('adminlte::page')
@section('title', 'Evento')

@section('content_header')
    <div id="toastr-notifications"></div>
    <h1>Eventos</h1>
@stop

@section('content')
    <div>
        <div class="card">
            <div class="card-head">
                <a href="{{ route('evento.create') }}" class="btn btn-primary mt-4 ml-4">Crear Evento</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 5%">ID</th>
                            <th scope="col" style="width: 25%">TITULO</th>
                            <th scope="col" style="width: 15%">DIRECCION</th>
                            <th scope="col" style="width: 15%">FECHA DEL EVENTO</th>
                            <th scope="col" style="width: 15%">FECHA CREACIÓN</th>
                            <th scope="col" style="width: 20%">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $c = 1;
                        @endphp
                        @foreach ($eventos as $evento)
                            <tr style="height: 150px;" id={{ $evento->id }}>
                                <td scope="row" style="width: 5%">{{ $c }}</td>
                                <td scope="row" style="width: 25%">{{ $evento->title }}</td>
                                <td scope="row" style="width: 15%">{{ $evento->address }}</td>
                                <td scope="row" style="width: 15%">{{ $evento->event_date }}</td>
                                <td scope="row" style="width: 20%">{{ $evento->created_at }}</td>
                                <td style="width: 15%">
                                    <button class="btn btn-secondary analizar-btn" data-id="{{ $evento->id }}"
                                        type="button">
                                        Editar
                                    </button>
                                    <a href="{{ route('evento.invitacion', $evento->id) }}"
                                        class="btn btn-secondary analizar-btn" data-id="{{ $evento->id }}" type="button">
                                        Invitar
                                    </a>
                                    <a href="{{ route('evento.cliente', $evento->id) }}"
                                        class="m-1 btn btn-secondary analizar-btn" data-id="{{ $evento->id }}"
                                        type="button">
                                        Clientes Vinculados
                                    </a>
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
    @if (session('toastr'))
        <script>
            $(document).ready(function() {
                console.log("mensaje de sesión");
                toastr.success('¡La imagen fué subida exitosamente!');
            });
        </script>
    @endif
@stop
