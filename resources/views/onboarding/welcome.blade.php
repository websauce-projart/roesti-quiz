@extends('template')

@section('title')
Bienvenue !
@endsection

@section('content')

<nav class="topnav topnav--right">
    <a href="{{ route('onboardingExit') }}" class="icon-close"></a>
</nav>

Salut à toi jeune Rösti !

Bienvenue au meilleur jeu de Romandie, Rösti Quiz !

En tant que présentateur, c’est ma mission de te guider à travers ton aventure röstienne... Allons-y !

<a href="{{route('onboardingAvatar')}}">Suivant</a>
@endsection