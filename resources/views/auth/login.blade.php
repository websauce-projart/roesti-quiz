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

    <header>
        <div>
            <a href="{{ route('register') }}">Créer un compte</a> |
            <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
        </div>
    </header>

    <form action="" method="post">
        @csrf

        {{-- Gérer les erreurs de saisie avec vue --}}
        @if (Session::has('account-deleted'))
        {{ Session::get('account-deleted') }}
        @endif
        <div>
            <x-input-text label="Pseudo ou email" id="pseudo" placeholder="Entrez votre pseudo ou votre email" icon="😃"
                value="{{ old('pseudo') }}"></x-input-text>
            {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
            <x-input-text label="Mot de passe" id="password" placeholder="Entrez votre pseudo..." icon="🔒"
                value="{{ old('password') }}" type="password"></x-input-text>
            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <div>
            <input type="checkbox" id="remember_token" name="remember_token" value="true">
            <label for="remember_token">Se souvenir de moi ?</label>
        </div>

        <div>
            <x-input-submit label="Se connecter"></x-input-submit>
        </div>

    </form>

    <div>
        @if (Session::has('account-created'))
        {{ Session::get('account-created') }}
        @endif

        @if ($errors->has('loginFailed'))
        😔 Désolé, le pseudo ou le mot de passe n'est pas correct 😔
        @endif

        @if (Session::has('account-verified'))
        {{ Session::get('account-verified') }}
        @endif

        @if ($errors->has('account-verify'))
        ⚠️ stp confirme ton mail ⚠️

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">si ta perdu ton mail clic ici lol</button>
        </form>
        @endif

        @if (session('email-resent'))
        {{ Session::get('email-resent') }}
        @endif
    </div>

</body>

</html>
