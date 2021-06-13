<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réinitialiser le mot de passe</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
</head>

<body>

    <header>
        <a href="{{ route('login') }}">Retour au login</a>
    </header>

    @if (Session::has('status'))
    <!-- forgot password (AuthC.) -->
    <div>{{ Session::get('status') }}</div>
    @endif

    @if (Session::has('email'))
    <!-- forgot password (AuthC.) -->
    <div>{{ Session::get('email') }}</div>
    @endif

    <form action="" method="post">
        @csrf

        <div class="center">
            <x-input-text label="Adresse e-mail" id="email" placeholder="Entrez votre adresse e-mail..." icon="📧">
            </x-input-text>
            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
            <br>
        </div>

        <div>
            <x-input-submit label="Envoyer un lien de réinitialisation!"></x-input-submit>
        </div>

    </form>
</body>

</html>