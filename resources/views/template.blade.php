<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ URL::asset('favicon.png') }}" type="image/png"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div>
        @yield('contenu')
    </div>
</body>

</html>
