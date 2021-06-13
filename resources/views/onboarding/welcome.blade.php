@extends('template')

@section('title')
Bienvenue !
@endsection

@section('content')

Salut à toi jeune Rösti !

Bienvenue au meilleur jeu de Romandie, Rösti Quiz !


Merci d'avoir vérifié ton adresse! En tant que présentateur, c’est ma mission de te guider à travers ton aventure röstienne... Allons-y !

<a href="{{route('onboardingAvatar')}}">Suivant</a>
@endsection