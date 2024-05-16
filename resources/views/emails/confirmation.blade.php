<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
</head>
<body>
<p>Hola {{ $patient->name }},</p>

<p>¡Gracias por registrarte en nuestro sitio!</p>

<p>Tu registro ha sido exitoso. Por favor, confirma tu correo electrónico haciendo clic en el siguiente enlace:</p>

<a href="{{ url('/verify-email/'.$patient->email_verification_token ) }}">Confirmar Email</a>

</body>
</html>
