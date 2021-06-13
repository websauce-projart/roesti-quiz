@extends('template')

@section('title')
Tutoriel
@endsection

@section('content')
<nav class="topnav topnav--right">
    <a href="{{ route('onboardingExit') }}" class="icon-close"></a>
</nav>

Tu peux voir les réponses du quiz à la fin de chaque round !

<a href="{{route('onboardingFriends')}}">Suivant</a>
@endsection