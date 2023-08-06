
@component('mail::message')

Dear {{ $name }},

Your account credentials are as follows:

Email: {{ $email }}
Password: {{ $password }}


@component('mail::button', ['url' => 'https://thelgoms.000webhostapp.com/'])
Click here to login
@endcomponent

@endcomponent