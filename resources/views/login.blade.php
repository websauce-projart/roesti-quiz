<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
</head>

<body>

    @if ($errors->has('loginFailed'))
    Désolé, le pseudo ou le mot de passe n'est pas correct
    @endif

    <form action="" method="post">
        @csrf

        {{-- Gérer les erreurs de saisie avec vue --}}
        <label for="pseudo">Pseudo</label>
        <input id="pseudo" name="pseudo" type="text" value="{{ old('pseudo') }}">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" value="{{ old('password') }}">
        <input type="submit" value="Envoyer">

    </form>

</body>

</html>