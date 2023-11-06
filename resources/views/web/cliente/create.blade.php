@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <div id="toastr-notifications"></div>
    <h1>Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Nuevo Cliente</h2>
        </div>
        <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto de perfil</label>
                            <div id="imagePreview"
                                style="display: flex; justify-content: center; align-items: center; max-width: 100%; max-height: 400px; width: 100%; height: 400px; border: 1px solid #ccc; background-color: #000000; overflow: hidden;">
                                <img id="preview" src="#" alt="Vista previa"
                                    style="max-width: 100%; max-height: 100%; display: none;">
                                <span id="noImageText" style="display: block">Imagen
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
                                        aria-describedby="ciHelp">
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
                                        aria-describedby="nameHelp">
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
                                        aria-describedby="lastnameHelp">
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
                                        aria-describedby="emailHelp" autocomplete="off">
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
                                        aria-describedby="number_phoneHelp">
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
                                        <option value="M">Maculino
                                        </option>
                                        <option value="F">Femenino
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
                                        aria-describedby="birth_dateHelp">
                                    <div id="birth_dateHelp" class="form-text">
                                        @error('birth_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- password --}}
                            <div class="col-md-12">
                                <div class="mb">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Contraseña" autocomplete="off">
                                    @error('password')
                                        <div class="alert alert-danger form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb">
                                    <label for="password_confirmation" class="form-label">Confirmación de
                                        Contraseña</label>
                                    <input name="password_confirmation" type="password" class="form-control"
                                        id="password_confirmation" placeholder="Confirmación de Contraseña"
                                        autocomplete="off">
                                    <span id="password_match_message" style="display: none;"></span>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger form-text">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" id="updatePerfilButton" class="btn btn-success">Guardar</button>
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
    <script src="{{ asset('js/rekognition-function.js') }}"></script>
    <script>
        $(document).ready(function() {
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
            let boundingBoxes = [];
            let boundingBoxescss = [];
            //Función para detectar si la imágen que está subiendo contiene un rostro
            function validate_profiles(photo) {
                //api/analyze/detect_face/photo_perfil
                const url = "/api/analyze/detect_face/photo_perfil";
                console.log('url: ', url);
                const formData = new FormData();
                formData.append('photo', photo);

                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData, // Usar el objeto FormData en lugar de un objeto plano
                    success: function(response) {
                        console.log(response.data);
                        //PARA COLOCAR CUADRO A LOS ROSTROS DETECTADOS EN LA FOTO
                        response.data.forEach(face => {
                            console.log("face: ", face);
                            console.log("face.BoundingBox: ", face.BoundingBox);
                            let boundingBox = face.BoundingBox;
                            let width = boundingBox.Width;
                            let height = boundingBox.Height;
                            let left = boundingBox.Left;
                            let top = boundingBox.Top;

                            var imagen = $("#preview");
                            console.log("imagen profile: ", imagen);
                            var imagenX = imagen.position().left;
                            var imagenY = imagen.position().top;
                            var imagenWidth = imagen.width();
                            var imagenHeight = imagen.height();
                            console.log('(' + imagenX + ',' + imagenY + ')')
                            var cuadroLeft = imagenX + left * imagenWidth;
                            var cuadroTop = imagenY + top * imagenHeight;
                            var cuadroWidth = width * imagenWidth;
                            var cuadroHeight = height * imagenHeight;

                            var recuadro = $("<div></div>");
                            recuadro.css({
                                position: "absolute",
                                left: cuadroLeft + "px",
                                top: cuadroTop + "px",
                                width: cuadroWidth + "px",
                                height: cuadroHeight + "px",
                                border: "2px solid red" // Puedes personalizar el estilo del recuadro
                            });
                            // Agrega el recuadro a la imagen
                            imagen.after(recuadro);
                            boundingBoxes.push(recuadro);
                        });

                        return true;
                    },
                    error: function(error) {
                        console.error("Hubo un error", error.responseJSON);
                        return false;
                    }
                });
            }
            // Función para mostrar la vista previa de la imagen seleccionada
            const inputPhoto = document.getElementById('photo');
            const previewImage = document.getElementById('preview');
            const noImageText = document.getElementById('noImageText');

            inputPhoto.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    console.log("file: ", file);
                    if (boundingBoxescss) {
                        boundingBoxescss.forEach(function(cuadro) {
                            cuadro.remove();
                        });
                    }
                    //let validate = validate_profiles(file); //función para validar que la imagen aparece una persona
                    var imagen = $("#preview");
                    var noimagen = $('#noImageText');
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        imagen.css('display', 'none');
                        noimagen.css('display', 'none');
                    };
                    reader.readAsDataURL(file);
                    
                    var imagenX = imagen.position().left;
                    var imagenY = imagen.position().top;
                    console.log('(' + imagenX + ',' + imagenY + ')')
                    let validate = validate_profile(file)
                        .then(response => {
                            if (response.data.length == 1) {
                                imagen.css('display', 'block');
                                noimagen.css('display', 'none');
                                boundingBoxes = encuadrarPerfil(imagen.position().left, imagen
                                    .position()
                                    .top,
                                    imagen.width(), imagen.height(), response.data);

                                boundingBoxes.forEach(function(cuadro) {
                                    console.log("cuadro: ", cuadro);
                                    var recuadro = $("<div></div>");
                                    recuadro.css(cuadro);
                                    imagen.after(recuadro);
                                    boundingBoxescss.push(recuadro);
                                })
                            } else {
                                this.value = "";
                                alert('Error la imágen sólo debe ser de su rostro');
                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    previewImage.src ="";
                                    imagen.css('display', 'none');
                                    noimagen.css('display', 'block');
                                   
                                };
                                reader.readAsDataURL(file);
                            }
                        })
                        .catch(error => {
                            // console.log("error: ", error);
                            imagen.css('display', 'none');
                            noimagen.css('display', 'block');
                            alert(error.responseJSON.message);
                            this.value = "";
                        });
                } else {
                    previewImage.style.display = 'none';
                    noImageText.style.display = 'block';
                }
            });
        });
    </script>
@stop
