@extends('template')

@section('nav')
<div>
    <div>
        <nav>
            <ol>
                <li><a href="{{url('logout')}}">Accueil</a></li>
                <li><a href="{{url('profil')}}">Profil</a></li>
                <li><a href="{{url('settings')}}">Réglages</a></li>
            </ol>
        </nav>
    </div>
    <div>
    <a href="{{url('logout')}}">Se déconnecter</a>
    <a href="{{url('logout')}}">Supprimer son compte</a>
    </div>
</div>
@endsection

