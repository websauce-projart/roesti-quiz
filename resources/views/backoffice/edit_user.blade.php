@extends('template')

@section('title')
Modifier un utilisateur
@endsection

@section('content')
<x-backoffice-nav></x-backoffice-nav>
<div class="container container--large">

    <div class="center">
        <a href="{{route('users.index')}}">Retour à la liste d'utilisateur</a>
    </div>

    <form class="form form--center" method="POST" action="{{route('users.update', [$user->id])}}"
        accept-charset="UTF-8">
        @csrf
        @method('PUT')

        <div class="form__row">
            <div class="{!! $errors->has('pseudo') ? 'has-error' : '' !!}">
                <input type="text" name="pseudo" value="{{$user->pseudo}}" placeholder="Pseudo">
                {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
            </div>
        </div>

        <div class="form__row">
            <div class="{!! $errors->has('email') ? 'has-error' : '' !!}">
                <input type="email" name="email" value="{{$user->email}}" placeholder="Email">
                {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
            </div>
        </div>

        <input type="hidden" name="id" value="{{$user->id}}">
        <input class="btn btn--primary" type="submit" value="Modifier">
    </form>
</div>

</div>
@endsection