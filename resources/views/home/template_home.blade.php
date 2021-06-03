@extends('template')

@section('nav')
<div>
    <div>
        <nav>
            <ol>
                <li><a href="{{route('logout')}}">Accueil</a></li>
                <li><a href="#">Profil</a></li>
                <li><a href="#">Réglages</a></li>
            </ol>
        </nav>
    </div>
    <div>
    <a href="{{route('logout')}}">Se déconnecter</a>
    <a href="{{route('logout')}}">Supprimer son compte</a>
    </div>
</div>
@endsection

