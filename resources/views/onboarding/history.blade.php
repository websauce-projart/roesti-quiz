@extends('template')

@section('title')
Tutoriel
@endsection

@section('content')
Tu peux voir les réponses du quiz à la fin de chaque round !

<a href="{{route('onboardingFriends')}}">Suivant</a>
@endsection