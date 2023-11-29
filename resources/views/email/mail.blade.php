<!DOCTYPE html>
<html>
<head>
    <title>Invitación</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <p>Haz clic en el enlace de abajo para aceptar la invitación:</p>
    <a href="{{ url('/accept-invitation/'.$evento) }}">Aceptar Invitación</a>
</body>
</html>
