<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réinitialisation du mot de passe</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
</head>

<body>

    @if (Session::has('status'))
    <!-- handleResetForm (AuthC.) -->
    <div>{{ Session::get('status') }}</div>
    @endif

    <form action="" method="post">
        @csrf

        <div>
            <x-input-text label="Adresse e-mail" id="email" placeholder="Entrez votre adresse e-mail..." icon="📧">
            </x-input-text>
            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
            <x-input-text label="Nouveau mot de passe" id="password" placeholder="Entrez votre mot de passe..."
                type="password" icon="🔒"></x-input-text>
            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
            <x-input-text label="Confirmation du nouveau mot de passe" id="password_confirmation"
                placeholder="Confirmez votre mot de passe..." type="password" icon="🔒"></x-input-text>
            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <input id="token" name="token" type="hidden" value="{{$token}}">

        <div>
            <x-input-submit label="Modifier mon mot de passe!"></x-input-submit>
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