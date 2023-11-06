function validate_profile(photo) {
    //api/analyze/detect_face/photo_perfil
    const url = "/api/analyze/detect_face/photo_perfil";
    console.log('url: ', url);
    const formData = new FormData();
    formData.append('photo', photo);
    try {
        const response = $.ajax({
            type: 'POST',
            url: url,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
        });
        // Procesa la respuesta aquí
        console.log("en el async: ", response);
        return response;
    } catch (error) {
        // Maneja los errores aquí
        console.error("Hubo un error", error);
        throw error; // Opcional: propagar el error para que se maneje en otro lugar
    }
}
function encuadrarPerfil(x, y, w, h, data) {
    console.log("data encuadra: ", data);
    let boundingBoxes = [];
    //PARA COLOCAR CUADRO A LOS ROSTROS DETECTADOS EN LA FOTO
    if (data.length == 1) {
        data.forEach(face => {
            console.log("face: ", face);
            console.log("face.BoundingBox: ", face.BoundingBox);
            let boundingBox = face.BoundingBox;
            let width = boundingBox.Width;
            let height = boundingBox.Height;
            let left = boundingBox.Left;
            let top = boundingBox.Top;
            var imagenX = x;
            var imagenY = y;
            var imagenWidth = w;
            var imagenHeight = h;
            var cuadroLeft = imagenX + left * imagenWidth;
            var cuadroTop = imagenY + top * imagenHeight;
            var cuadroWidth = width * imagenWidth;
            var cuadroHeight = height * imagenHeight;

            boundingBoxes.push({
                position: "absolute",
                left: cuadroLeft + "px",
                top: cuadroTop + "px",
                width: cuadroWidth + "px",
                height: cuadroHeight + "px",
                border: "2px solid red"
            });
        });
    }

    return boundingBoxes;
}
function encuadrarFotoEvento(x, y, w, h, data) {
    let boundingBoxes = [];
    //PARA COLOCAR CUADRO A LOS ROSTROS DETECTADOS EN LA FOTO
    data.forEach(face => {
        let boundingBox = face.BoundingBox;

        let width = boundingBox.Width;
        let height = boundingBox.Height;
        let left = boundingBox.Left;
        let top = boundingBox.Top;

        var imagenX = x;
        var imagenY = y;
        var imagenWidth = w;
        var imagenHeight = h;

        var cuadroLeft = imagenX + left * imagenWidth;
        var cuadroTop = imagenY + top * imagenHeight;
        var cuadroWidth = width * imagenWidth;
        var cuadroHeight = height * imagenHeight;

        boundingBoxes.push({
            position: "absolute",
            left: cuadroLeft + "px",
            top: cuadroTop + "px",
            width: cuadroWidth + "px",
            height: cuadroHeight + "px",
            border: "2px solid red"
        });
    });
    return boundingBoxes;
}