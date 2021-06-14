<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rösti Quiz | @yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="manifest" href="manifest.json">
</head>

<body class="@stack('body-classes')">
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('script')
</body>

</html>
