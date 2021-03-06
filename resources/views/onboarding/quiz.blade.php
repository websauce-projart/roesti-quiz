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
		<h1 class="onboarding__title">RöstiQuiz, c'est:</h1>
		<div class="onboarding__text">
			<p>Tous les <mark>fun facts</mark> de Romandie réunis en un seul jeu</p>
			<p>Une manière amusante de <mark>défier tes proches</mark> ou des inconnu·es</p>
			<p>Un présentateur <mark>particulièremment charismatique</mark></p>
			<p>Des parties <mark>rapides</mark> et des questions originales</p>
		</div>
	</div>

	<div class="bottombar">
		<ul class="onboarding__step">
			<li class="active"></li>
			<li></li>
			<li></li>
		</ul>
		<a class="btn btn--primary" href="{{route('onboardingSwipe')}}">Suivant</a>
	</div>
</div>
@endsection
