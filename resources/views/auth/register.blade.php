<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
</head>

<body>

    <header>
        <input type="button" value="Retour au login" onclick="window.history.back()" />
    </header>

    <form action="" method="post">
        @csrf

        {{-- Gérer les erreurs de saisie avec vue --}}

        <div>
        <x-input-text label="Pseudo" id="pseudo" placeholder="Entrez votre pseudo..." icon="😃"></x-input-text>
        {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
        <x-input-text label="Adresse e-mail" id="email" placeholder="Entrez votre adresse e-mail..." icon="📧"></x-input-text>
        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
        <x-input-text label="Mot de passe" id="password" placeholder="Entrez votre mot de passe..." type="password" icon="🔒"></x-input-text>
        {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
        <x-input-text label="Confirmation du mot de passe" id="password_confirmation" placeholder="Confirmez votre mot de passe..." type="password" icon="🔒"></x-input-text>
        {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
            <x-input-submit label="Roestification!"></x-input-submit>
        </div>
    </form>
</body>

</html>
