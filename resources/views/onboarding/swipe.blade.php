@extends('template')

@section('title')
Tutoriel
@endsection

@push('body-classes', 'bg--lightblue')

@section('content')
<div class="container">
	<nav class="topnav">
		<a href="{{ route('onboardingExit') }}" class="icon-close"></a>
	</nav>

	<div class="onboarding">
		<div class="onboarding__title">
			Balaie ton écran à gauche ou à droite pour répondre
		</div>

		<div class="onboarding__img">
			<img src="{{ asset("img/onboarding/swipe.png") }}" alt="">
		</div>

	</div>

	<div class="bottombar">
		<ul class="onboarding__step">
			<li></li>
			<li class="active"></li>
			<li></li>
		</ul>
		<a class="btn btn--primary" href="{{route('onboardingFriends')}}">Suivant</a>
	</div>
</div>
@endsection
