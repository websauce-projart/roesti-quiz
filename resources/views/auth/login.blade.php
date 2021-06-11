@extends('template')

@section('title')
    Connexion
@endsection

@section('content')

    <body>
        <div class="container">
            <header class="header header--login">
                <nav class="topnav topnav--right">
                    <a href="{{ route('register') }}">Créer un compte</a>
                </nav>
                <img class="logo" src="img/logo_v2_1.svg" alt="Rösti Quiz" />
            </header>

            <main>
                <form action="" method="post" class="form form--center">
                    @csrf

                    @if (Session::has('account-deleted'))
                        {{ Session::get('account-deleted') }}
                    @endif

                    <div class="form__row">
                        <x-input-text label="Pseudo ou email" id="pseudo" placeholder="Entrez votre pseudo ou votre email"
                            icon="user" value="{{ old('pseudo') }}"></x-input-text>
                        {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form__row">
                        <x-input-text label="Mot de passe" id="password" placeholder="Entrez votre pseudo..." icon="lock-closed"
                            value="{{ old('password') }}" type="password"></x-input-text>
                        {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form__row form__row--left form__row--space">
                        <input type="checkbox" id="remember_token" name="remember_token" value="true">
                        <label for="remember_token">Se souvenir de moi ?</label>
                    </div>

                    <div class="form__row">
                        <x-input-submit label="Se connecter"></x-input-submit>
                    </div>

                    <div class="form__row">
                        <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
                    </div>

                </form>

                <div>
                    
                    @if ($errors->has('login-failed'))
                        😔 Désolé, le pseudo ou le mot de passe n'est pas correct... 😔
                    @endif

                </div>
            </main>
        </div>
    </body>

@endsection
