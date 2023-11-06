@extends('adminlte::page')
@section('title', 'Clientes')

@section('content_header')
    <h1>Lista de imagenes</h1>
    <div id="toastr-notifications"></div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('user.create') }}" class="btn btn-primary">Crear Cliente</a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 5%">NRO</th>
                        <th scope="col" style="width: 25%">NOMBRE Y APELLIDO</th>
                        <th scope="col" style="width: 15%">EDAD</th>
                        <th scope="col" style="width: 20%">PERFIL</th>
                        <th scope="col" style="width: 15%">FECHA CREACIÓN</th>
                        <th scope="col" style="width: 20%">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $c = 1;
                    @endphp
                    @foreach ($clientes as $cliente)
                        <tr style="height: 150px;" id={{ $cliente->user->id }}>
                            <td scope="row" style="width: 5%">{{ $c }}</td>
                            <td scope="row" style="width: 25%">{{ $cliente->user->name }} {{ $cliente->user->lastname }}
                            </td>

                            <td scope="row" class="age" style="width: 15%" data-id={{ $cliente->user->birth_date }}>

                            </td>
                            <td style="width: 20%">
                                <div
                                    style="width: 100%; height: 150px; background-color: black; display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ Storage::disk('s3')->url($cliente->user->images->where('tipo', 'P')->first()->url) }}"
                                        alt="Imagen Subida" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            </td>
                            <td scope="row" style="width: 20%">{{ $cliente->created_at }}</td>
                            <td style="width: 15%">
                                <button class="btn btn-secondary analizar-btn" data-id="{{ $cliente->id }}" type="button">
                                    Editar
                                </button>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function calcularEdad(fechaNacimiento) {
            const fechaNac = new Date(fechaNacimiento);
            const fechaActual = new Date();
            const edad = fechaActual.getFullYear() - fechaNac.getFullYear();

            if (fechaActual.getMonth() < fechaNac.getMonth() || (fechaActual.getMonth() === fechaNac.getMonth() &&
                    fechaActual.getDate() < fechaNac.getDate())) {
                edad--;
            }

            return edad;
        }
        $(document).ready(function() {
            $(".age").each(function() {
                const fechaNacimiento = $(this).data("id");
                const fechaNac = new Date(fechaNacimiento);
                console.log(fechaNac)
                const fechaActual = new Date();
                const edad = fechaActual.getFullYear() - fechaNac.getFullYear();
                
                // if (fechaActual.getMonth() < fechaNac.getMonth() || (fechaActual.getMonth() === fechaNac
                //         .getMonth() &&
                //         fechaActual.getDate() < fechaNac.getDate())) {
                //     edad--;
                // }
                console.log(edad);
                $(this).text(edad);
            })
        });
        console.log("Hi!")
    </script>
@stop
