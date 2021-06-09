@extends('template')

@section('title')
    Connexion
@endsection

@section('content')

    <body class="container">
        <header class="header--login">
            <nav class="topnav topnav--right">
                <a href="{{ route('register') }}">Créer un compte</a>
            </nav>
            <img class="logo" src="img/logo_v2_1.svg" alt="Rösti Quiz" />
        </header>

        <main>
            <form action="" method="post">
                @csrf

                @if (Session::has('account-deleted'))
                    {{ Session::get('account-deleted') }}
                @endif
                <div class="center">
                    <x-input-text label="Pseudo ou email" id="pseudo" placeholder="Entrez votre pseudo ou votre email"
                        icon="😃" value="{{ old('pseudo') }}"></x-input-text>
                    {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="center">
                    <x-input-text label="Mot de passe" id="password" placeholder="Entrez votre pseudo..." icon="🔒"
                        value="{{ old('password') }}" type="password"></x-input-text>
                    {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="checkbox center">
                    <input type="checkbox" id="remember_token" name="remember_token" value="true">
                    <label for="remember_token">Se souvenir de moi ?</label>
                </div>

                <div>
                    <x-input-submit label="Se connecter"></x-input-submit>
                    <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
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
                        <button type="submit" class="btn btn--primary btn-link p-0 m-0 align-baseline">si ta perdu ton mail
                            clic
                            ici
                            lol</button>
                    </form>
                @endif

                @if (session('email-resent'))
                    {{ Session::get('email-resent') }}
                @endif
            </div>
        </main>

    </body>

@endsection
