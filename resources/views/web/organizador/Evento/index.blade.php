@extends('adminlte::page')
@section('title', 'Evento')

@section('content_header')
    <div id="toastr-notifications"></div>
    <h1>Eventos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('evento.create') }}" class="btn btn-primary">Crear Evento</a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 5%">NRO</th>
                        <th scope="col" style="width: 25%">TITULO</th>
                        <th scope="col" style="width: 20%">DIRECCION</th>
                        <th scope="col" style="width: 15%">FECHA EVENTO</th>
                        <th scope="col" style="width: 20%">ESTADO</th>
                        <th scope="col" style="width: 15%">OPCIONES</th>
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
                            <td scope="row" style="width: 20%">{{ $evento->address }}</td>
                            <td scope="row" style="width: 15%">{{ $evento->event_date }}</td>
                            <td scope="row" style="width: 20%">
                                <select class="form-control" name="status" id="status" style="width: 80%"
                                    data-evento-id={{ $evento->id }} data-evento-title="{{ $evento->title }}">
                                    <option value=1 style="background: #ffffff; color:black"
                                        {{ $evento->status == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value=2 style="background: #ffffff; color:black"
                                        {{ $evento->status == 2 ? 'selected' : '' }}>Cancelado</option>
                                    <option value=3 style="background: #ffffff; color:black"
                                        {{ $evento->status == 3 ? 'selected' : '' }}>Finalizado</option>
                                </select>
                            </td>


                            <td scope="row" style="width: 15%">
                                <button class="btn btn-secondary analizar-btn" type="button">
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            selectStatus = $('#status');
            if (selectStatus.val() == 1) {
                selectStatus.css('background', '#16FF00');
                selectStatus.css('color', '#ffffff');
            }
            if (selectStatus.val() == 2) {
                selectStatus.css('background', '#F94A29');
                selectStatus.css('color', '#ffffff');
            }
            if (selectStatus.val() == 3) {
                selectStatus.css('background', '#000000');
                selectStatus.css('color', '#ffffff');
            }
            $('#status').on('change', function() {
                //alert(this.value);
                selectStatus = $(this);
                const selectedValue = selectStatus.val();
                const eventId = selectStatus.data('evento-id');
                const eventTitle = selectStatus.data('evento-title');

                if (selectedValue == 1) {
                    selectStatus.css('background', '#16FF00');
                    
                }
                if (selectedValue == 2) {
                    selectStatus.css('background', '#F94A29');
                   
                }
                if (selectedValue == 3) {
                    selectStatus.css('background', '#000000');
                  
                }
                selectStatus.prop('disabled', true); // Deshabilita el select
                const url = '/api/evento/update_status/' + eventId;
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: url, // Reemplaza con la URL de tu solicitud AJAX
                    data: {
                        status: selectedValue
                    },
                    success: function(response) {
                        console.log('response: ', response);

                        toastr.success('Estado del evento ' + eventTitle + ' actualizado con éxito');
                    },
                    complete: function() {
                        selectStatus.prop('disabled',
                            false); // Habilita el select después de la respuesta
                    },
                    error: function(error) {
                        toastr.error('Ha ocurrido un error al actualizar el estado del evento '+eventTitle);
                        // Manejar errores en caso de fallo
                        console.error(error);
                    }
                });
            });
        });
    </script>
@stop
