@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <div id="toastr-notifications"></div>
    <h1>Perfil</h1>
@stop

@section('content')
    <div class="card">
        @php
            $user = auth::user();
        @endphp
        <div class="card-header">
            <h2>Datos Personales</h2>
        </div>
        <form id="updatePerfilForm" enctype="multipart/form-data" autocomplete="nope">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto de perfil</label>
                            <div id="imagePreview"
                                style="display: flex; justify-content: center; align-items: center; max-width: 100%; max-height: 400px; width: 100%; height: 400px; border: 1px solid #ccc; background-color: #000000; overflow: hidden;">
                                <img id="preview"
                                    src="{{ isset($user->images->where('tipo','P')->first()->url) ? Storage::disk('s3')->url($user->images->where('tipo','P')->first()->url) : '#' }}"
                                    alt="Vista previa"
                                    style="max-width: 100%; max-height: 100%; display: {{ isset($user->images->first()->url) ? 'block' : 'none' }};">
                                <span id="noImageText"
                                    style="{{ isset($user->images->where('tipo','P')->first()->url) ? 'display: none' : 'display: block' }}">Imagen
                                    no
                                    seleccionada</span>
                            </div>


                            <div class="mt-1">
                                <input type="file" class="form-control" name="photo" id="photo"
                                    accept=".jpeg, .jpg, .png">
                                <div id="photo" class="form-text">
                                    @error('photo')
                                        <div class="alert alert-danger form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-1">
                                    <label for="ci" class="form-label">CI</label>
                                    <input type="text" name="ci" class="form-control" id="ci"
                                        aria-describedby="ciHelp" value="{{ $user->ci }}" readonly>
                                    <div id="ciHelp" class="form-text">
                                        @error('ci')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-1">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        aria-describedby="nameHelp" value="{{ $user->name }}">
                                    <div id="nameHelp" class="form-text">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-1">
                                    <label for="lastname" class="form-label">Apellido</label>
                                    <input type="text" name="lastname" class="form-control" id="lastname"
                                        aria-describedby="lastnameHelp" value="{{ $user->lastname }}">
                                    <div id="lastnameHelp" class="form-text">
                                        @error('lastname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-1">
                                    <label for="email" class="form-label">Correo</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        aria-describedby="emailHelp" value="{{ $user->email }}">
                                    <div id="emailHelp" class="form-text">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-1">
                                    <label for="number_phone" class="form-label">Celular</label>
                                    <input type="text" name="number_phone" class="form-control" id="number_phone"
                                        aria-describedby="number_phoneHelp" value="{{ $user->number_phone }}">
                                    <div id="number_phoneHelp" class="form-text">
                                        @error('number_phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-1">
                                    <label for="gender" class="form-label">Sexo</label>
                                    <select class="form-control" aria-label="Default select example" id="gender"
                                        name="gender">
                                        <option value="M" @if ($user->gender === 'M') selected @endif>Maculino
                                        </option>
                                        <option value="F" @if ($user->gender === 'F') selected @endif>Femenino
                                        </option>
                                    </select>
                                    <div id="genderHelp" class="form-text">
                                        @error('gender')
                                            <div class="alert alert-danger form-text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb">
                                    <label for="birth_date" class="form-label">Fecha de nacimiento</label>
                                    <input type="date" name="birth_date" class="form-control" id="birth_date"
                                        aria-describedby="birth_dateHelp" value="{{ $user->birth_date }}">
                                    <div id="birth_dateHelp" class="form-text">
                                        @error('birth_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb">
                                    <label for="birth_date" class="form-label">Tipo de usuario</label>
                                    <label class="form-control" for="controlInput">
                                        @if ($user->tipo === 'A')
                                            Admin
                                        @elseif ($user->tipo === 'O')
                                            Organizador
                                        @elseif ($user->tipo === 'F')
                                            Fotografo
                                        @else
                                            Cliente
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="button" id="updatePerfilButton" class="btn btn-success">Actualizar</button>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h2>Cambiar contraseña</h2>
        </div>
        <form id="updatePasswordForm" autocomplete="off">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="controlAfterPassword">Anterior contraseña</label>
                            <input type="password" name="before_password" class="form-control" id="before_password"
                                placeholder="Contraseña" autocomplete="off" required>
                            @error('before_password')
                                <div class="alert alert-danger form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="controlPassword">Nueva Contraseña</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Contraseña" autocomplete="off">
                            @error('password')
                                <div class="alert alert-danger form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="controlPassword">Confirmación de Contraseña</label>
                            <input name="password_confirmation" type="password" class="form-control"
                                id="password_confirmation" placeholder="Confirmación de Contraseña" autocomplete="off">
                            <span id="password_match_message" style="display: none;"></span>
                            @error('password_confirmation')
                                <div class="alert alert-danger form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="button" id="updatePasswordButton" class="btn btn-success">Actualizar</button>
            </div>
        </form>
    </div>

@stop

@section('css')
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
            // $('#before_password').val('');
            //**************ACTUALIZAR PASSWORD CON AJAX
            $('#updatePasswordButton').on('click', function() {
                console.log("hace click button contraseña")
                //const form = document.getElementById("updatePasswordForm"); //$('#updatePerfilForm');
                const beforePassword = $('#before_password').val();
                const password = $('#password').val();
                const passwordConfirmation = $('#password_confirmation').val();

                const newFormData = {
                    'before_password': beforePassword,
                    'password': password,
                    'password_confirmation': passwordConfirmation,
                    '_token': '{{ csrf_token() }}' // Agregar el token CSRF
                }
                console.log('datos: ', newFormData);
                const url = "/api/perfil/user/password/" + {{ $user->id }};
                console.log('url: ', url);
                $.ajax({
                    type: 'POST', // Cambia a la HTTP request que corresponda
                    url: url, // Cambia a la URL de tu servidor
                    dataType: "json",
                    data: newFormData,
                    success: function(response) {
                        $('#before_password').val("");
                        $('#password').val("");
                        $('#password_confirmation').val("");
                        $("#password_match_message").css("display","none");
                        toastr.success('Contraseña actualizada con éxito');
                        console.log(response);
                    },
                    error: function(error) {
                        toastr.error('Ha ocurrido un error al actualizar la contraseña');
                        // Manejar errores en caso de fallo
                        console.error(error);
                    }
                });
            });
            //**************ACTUALIZAR PERFIL CON AJAX
            $('#updatePerfilButton').on('click', function() {
                console.log("hace click")
                const form = document.getElementById("updatePerfilForm"); //$('#updatePerfilForm');
                const newFormData = new FormData(form);
                console.log("Mostrando los datos de newFormData:");
                newFormData.forEach((value, key) => {
                    console.log(key, value);
                });
                const url = "/api/perfil/user/" + {{ $user->id }};
                console.log('url: ', url);
                $.ajax({
                    type: 'POST', // Cambia a la HTTP request que corresponda
                    url: url, // Cambia a la URL de tu servidor
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: newFormData,
                    success: function(response) {
                        toastr.success('Perfil actualizado con éxito');
                        $('#photo').val(''); 
                        console.log(response);
                    },
                    error: function(error) {
                        toastr.error('Ha ocurrido un error al actualizar el perfil');
                        console.error(error);
                    }
                });
                console.log("newFormData: ", newFormData);

            });
            //*******************************************
            $("#password_confirmation").on("keyup", function() {
                const password = $("#password").val();
                console.log("password: ", password);
                const passwordConfirmation = $(this).val();
                const messageSpan = $("#password_match_message");
                if (password === passwordConfirmation) {
                    messageSpan.text("Las contraseñas coinciden").css("color", "green").show();
                } else {
                    messageSpan.text("Las contraseñas no coinciden").css("color", "red").show();
                }
            });

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
        });
    </script>
@stop
