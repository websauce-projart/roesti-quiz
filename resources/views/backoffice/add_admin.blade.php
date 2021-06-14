@extends('template')

@section('title')
Ajouter un administrateur
@endsection

@push('body-classes')
pattern-stop
@endpush

@section('content')

<x-backoffice-nav></x-backoffice-nav>

<div class="container container--large">
    <div class="center">
        <a href="{{route('admins.index')}}">Liste des administrateurs</a> | <strong>Créer un administrateur</strong>
    </div>

    <form action="{{route('admins.store')}}" method="post" class="form form--center">
        @csrf

        {{-- Gérer les erreurs de saisie avec vue --}}

        <div class="form__row">
            <x-input-text label="Pseudo" id="pseudo" placeholder="Entrez un pseudo..." icon="user" value="{{ old('pseudo') }}"></x-input-text>
            {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
        </div>

        <div class="form__row">
            <x-input-text label="Adresse e-mail" id="email" placeholder="Entrez un adresse e-mail..." icon="envelope" value="{{ old('email') }}">
            </x-input-text>
            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>

        <div class="form__row">
            <x-input-text label="Mot de passe" id="password" placeholder="Entrez un mot de passe..." type="password"
                icon="lock-closed"></x-input-text>
            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <div class="form__row">
            <x-input-text label="Confirmation du mot de passe" id="password_confirmation"
                placeholder="Confirmez un mot de passe..." type="password" icon="lock-closed"></x-input-text>
            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <div class="form__row">
            <button class="btn btn--primary" type="submit" name="submit">Ajouter</button>
        </div>
    </form>

</div>
@endsection
