<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello {{ $name }}</h1>
    <h1>{{ $email }}</h1>
    <h1>{{ $password }}</h1>
</body>
</html> -->

@component('mail::message')

Dear {{ $name }},

Your account credentials are as follows:

Email: {{ $email }}
Password: {{ $password }}


@component('mail::button', ['url' => 'https://thelgoms.000webhostapp.com/'])
Click here to login
@endcomponent

@endcomponent