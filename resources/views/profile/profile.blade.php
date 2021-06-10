@extends('template')

@section('title')
Profil
@endsection

@section('content')
<div>
    <x-avatar 
    posePath="{{$data['user']->getPosePath()}}"
    eyePath="{{$data['user']->getMouthPath()}}"
    mouthPath="{{$data['user']->getEyePath()}}"
    ></x-avatar>
    <a href="{{route('updateAvatar')}}">Edit avatar</a>
</div>
</br>
<div>
    {{$data['user']->pseudo}}
    </br>
    {{$data['score']['titleScore']}} - {{$data['score']['points']}}
</div>
</br>
<div>
    <a href="{{route('updatePasswordForm')}}">Modifier mon mot de passe</a></li>
    </br>
    <form class="form-horizontal" method="post" action="{{route('deleteAccount')}}" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">
        @csrf
        <input type="submit" value="Supprimer mon compte">
    </form>
</div>
</br>
<div>
    Mes trophées

    Liste des trophées
</div>

@endsection