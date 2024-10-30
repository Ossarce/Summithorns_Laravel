<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensaje de Contacto</title>
</head>
<body>
    <h2>Nuevo Mensaje de Contacto</h2>
    <p><strong>Nombre:</strong>{{$contactData['name']}}</p>
    <p><strong>Correo:</strong> {{ $contactData['email'] }}</p>
    <p><strong>Razón:</strong> {{ $contactData['purpose'] }}</p>
    <p><strong>Mensaje:</strong> {{ $contactData['message'] }}</p>
</body>
</html>
