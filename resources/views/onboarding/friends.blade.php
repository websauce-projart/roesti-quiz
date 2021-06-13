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
		<div class="unboarding__title">
			Défie tes proches et montre leur qui est le meilleur rösti !
		</div>

		<div class="unboarding__img">
			<img src="http://placehold.it/600" alt="">
		</div>
	</div>

	<div class="bottombar">
		<ul class="unboarding__step">
			<li></li>
			<li></li>
			<li class="active"></li>
		</ul>
		<a class="btn btn--primary" href="{{route('onboardingFriends')}}">Terminer</a>
	</div>
</div>
@endsection
