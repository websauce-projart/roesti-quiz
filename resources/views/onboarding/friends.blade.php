@extends('template')

@section('title')
Tutoriel
@endsection

@section('content')
<div class="container">
	<nav class="topnav">
		<a href="{{ route('onboardingExit') }}" class="icon-close"></a>
	</nav>

	<div class="unboarding">
		<div class="unboarding__title">
			Défie tes proches et montre leur qui est le meilleur rösti !
		</div>

		<div class="unboarding__img">
			<img src="{{ asset("img/unboarding/friends.svg") }}" alt="">
		</div>
	</div>

	<div class="bottombar">
		<ul class="unboarding__step">
			<li></li>
			<li></li>
			<li class="active"></li>
		</ul>
		<a class="btn btn--primary" href="{{route('onboardingExit')}}">Terminer</a>
	</div>
</div>
@endsection
