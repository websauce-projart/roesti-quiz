@extends('template')

@section('title')
Tutoriel
@endsection

@section('content')
<nav class="topnav topnav--right">
    <a href="{{ route('onboardingExit') }}" class="icon-close"></a>
</nav>

Réponds aux questions par vrai ou faux

<a href="{{route('onboardingHistory')}}">Suivant</a>
@endsection