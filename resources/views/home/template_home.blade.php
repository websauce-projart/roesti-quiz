@extends('template')

@section('nav')
<div>
    <div>
        <nav>
            <ol>
                <li><a href="{{route('home')}}">Accueil</a></li>
                <li><a href="{{route('profile')}}">Profil</a></li>
            </ol>
        </nav>
    </div>
    <div>
    <a href="{{route('logout')}}">Se déconnecter</a>
    <a href="{{route('logout')}}">Supprimer son compte</a>
    </div>
</div>
@endsection

