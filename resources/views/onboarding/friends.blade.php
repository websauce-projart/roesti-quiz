@extends('template')

@section('title')
Tutoriel
@endsection

@section('content')
<nav class="topnav topnav--right">
    <a href="{{ route('onboardingExit') }}" class="icon-close"></a>
</nav>

Défie tes proches et montre leur qui est le meilleur rösti !

<a href="{{route('onboardingExit')}}">Terminer</a>
@endsection