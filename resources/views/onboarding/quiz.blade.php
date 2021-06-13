@extends('template')

@section('title')
Tutoriel
@endsection

@section('content')
<div class="container">
	<nav class="topnav topnav--right">
		<a href="{{ route('onboardingExit') }}" class="icon-close"></a>
	</nav>

	<div class="unboarding">
		<h1 class="unboarding__title">Réponds aux questions par vrai ou faux</h1>
		<div class="unboarding__img">
			<img src="http://placehold.it/600" alt="">
		</div>
	</div>

	<div class="bottombar">
		<ul class="unboarding__step">
			<li class="active"></li>
			<li></li>
			<li></li>
		</ul>
		<a class="btn btn--primary" href="{{route('onboardingHistory')}}">Suivant</a>
	</div>
</div>
@endsection
