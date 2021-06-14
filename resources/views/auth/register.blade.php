@extends('template')

@section('title')
    S'enregister
@endsection

@section('content')

    <div class="container container--fullheight">
        <nav class="topnav">
            <a href="{{ route('login') }}" class="icon-arrow-left" aria-label="Retour"></a>
            <h1 class="pageTitle">Créer un compte</h1>
        </nav>

        <form action="" method="post" class="form form--center">
            @csrf

            <div class="form__row">
                <x-input-text label="Pseudo" id="pseudo" placeholder="Entrez votre pseudo..." icon="user" value="{{ old('pseudo') }}"></x-input-text>
                {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form__row">
                <x-input-text label="Adresse e-mail" id="email" placeholder="Entrez votre adresse e-mail..."
                    icon="envelope" value="{{ old('email') }}">
                </x-input-text>
                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form__row">
                <x-input-text label="Mot de passe" id="password" placeholder="Entrez votre mot de passe..." type="password"
                    icon="lock-closed"></x-input-text>
                {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form__row">
                <x-input-text label="Confirmation du mot de passe" id="password_confirmation"
                    placeholder="Confirmez votre mot de passe..." type="password" icon="lock-closed"></x-input-text>
                {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form__row">
                <x-input-submit label="Valider"></x-input-submit>
            </div>
        </form>
    </div>
@endsection
