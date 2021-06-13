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
			Tu peux voir les réponses du quiz à la fin de chaque round !
		</div>
	</div>

	<div class="bottombar">
		<ul class="unboarding__step">
			<li></li>
			<li class="active"></li>
			<li></li>
		</ul>
		<a class="btn btn--primary" href="{{route('onboardingFriends')}}">Suivant</a>
	</div>
</div>
@endsection
