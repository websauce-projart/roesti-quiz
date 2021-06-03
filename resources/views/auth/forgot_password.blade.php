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
        <input type="button" value="Retour au login" onclick="window.history.back()" />
    </header>

    <form action="/forgot-password" method="post">
        @csrf

        {{-- Gérer les erreurs de saisie avec vue --}}

        <div>
            <x-input-text label="Adresse e-mail" id="email" placeholder="Entrez votre adresse e-mail..." icon="📧">
            </x-input-text>
            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
            <x-input-submit label="Envoyer un lien de réinitialisation!"></x-input-submit>
        </div>

        <div>
            @if (Session::has('status'))
            {{ Session::get('status') }}
            @endif

            @if (Session::has('email'))
            {{ Session::get('email') }}
            @endif
        </div>

    </form>
</body>

</html>