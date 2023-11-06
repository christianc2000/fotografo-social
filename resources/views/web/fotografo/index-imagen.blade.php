@extends('adminlte::page')
@section('title', 'Imagen')

@section('content_header')
    <h1>Lista de imagenes</h1>
    <div id="toastr-notifications"></div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('fotografo.upload.imagen') }}" class="btn btn-primary">Subir imagen</a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 10%">NRO</th>
                        <th scope="col" style="width: 10%">ID</th>
                        <th scope="col" style="width: 30%">CLIENTES</th>
                        <th scope="col" style="width: 30%">IMAGEN</th>
                        <th scope="col" style="width: 20%">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $c = 1;
                    @endphp
                    @foreach ($imagenes as $imagen)
                        <tr style="height: 150px;" id={{ $imagen->id }}>
                            <th scope="row" style="width: 10%">{{ $c }}</th>
                            <th scope="row" style="width: 10%">{{ $imagen->id }}</th>
                            <td id="list-clientes" style="width: 30%">
                                @foreach (collect(json_decode($imagen->clientes)) as $cliente)
                                    <span
                                        class="p-2 rounded bg-success text-white mb-2 d-inline-flex align-items-center justify-content-center"
                                        style="min-width: {{ strlen($cliente->name) * 10 }}px;">{{ $cliente->name }}</span>
                                @endforeach
                            </td>
                            <td style="width: 30%">
                                <div
                                    style="width: 100%; height: 150px; background-color: black; display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ Storage::disk('s3')->url($imagen->url) }}" alt="Imagen Subida"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            </td>
                            <td style="width: 20%">
                                <button class="btn btn-secondary analizar-btn" data-imagen-id="{{ $imagen->id }}"
                                    data-cliente-id="{{ $imagen->imageable_id }}" type="button">Analizar</button>
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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
    <script>
        $(document).ready(function() {
            $('.analizar-btn').on('click', function() {
                const imagenId = parseInt($(this).data('imagen-id'));
                const clienteId = $(this).data('cliente-id');
                const clienteTd = $(this).closest('tr').find(
                    '#list-clientes'); // Encuentra el <td> de clientes correspondiente
                console.log('imagen id: ', imagenId);
                console.log('cliente id: ', clienteId);
                const url = "/api/analyze/imagen/fotografo/" + clienteId;
                console.log('url: ', url);

                //var parametro = "valor_del_parametro";

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json', // El tipo de datos que esperas recibir como respuesta
                    data: {
                        image_id: imagenId // Aquí puedes agregar más pares clave-valor según tus necesidades
                    },
                    success: function(response) {
                        console.log("response: ",response);
                        // Maneja la respuesta del servidor en 'response'
                        const clientes = response.data.clientes;
                        console.log('Respuesta del servidor:', clientes);
                        clienteTd.empty(); // Vacía el contenido actual
                        $.each(clientes, function(index, cliente) {
                            const span = $('<span>').addClass(
                                    'p-2 rounded bg-success text-white mb-2 d-inline-flex align-items-center justify-content-center'
                                ).css('min-width', cliente.name.length * 10 + 'px')
                                .text(cliente.name);
                            clienteTd.append(span);
                        });
                    },
                    error: function(xhr, status, error) {
                        // Maneja los errores aquí
                        console.error('Error en la solicitud:', error);
                    }
                });
            });
        });
    </script>
@stop
