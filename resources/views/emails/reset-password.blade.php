<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablece tu contraseña</title>
</head>
<body>
    <p>Hola,</p>
    <p>Puedes restablecer tu contraseña haciendo clic en el siguiente enlace:</p>
    <a href="{{ url('/reset-password?token=' . $token) }}">Restablece tu contraseña</a>
    <p>Si no solicitaste un cambio de contraseña, ignora este correo.</p>
<
