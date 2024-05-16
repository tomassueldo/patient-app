<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
</head>
<body>
<p>Hello {{ $patient->name }},</p>

<p>Thank you for registering on our site!</p>

<p>Your registration was successful. Please confirm your email by clicking on the following link:</p>

<a href="{{ url('/verify-email/'.$patient->email_verification_token ) }}">Confirm Email</a>

</body>
</html>
