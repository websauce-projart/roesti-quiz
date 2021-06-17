@extends('template')

@section('title')
Tutoriel
@endsection

@section('content')
<div class="container">
	<nav class="topnav">
		<a href="{{ route('onboardingExit') }}" class="icon-close"></a>
	</nav>

	<div class="onboarding">
		<div class="onboarding__title">
			Défie tes proches et montre leur qui est le meilleur rösti !
		</div>

		<div class="onboarding__img">
			<img src="{{ asset("img/onboarding/friends.svg") }}" alt="Tutorial friends" draggable="false">
		</div>
	</div>

	<div class="bottombar">
		<ul class="onboarding__step">
			<li></li>
			<li></li>
			<li class="active"></li>
		</ul>
		<a class="btn btn--primary" href="{{route('onboardingExit')}}">Terminer</a>
	</div>
</div>
@endsection
