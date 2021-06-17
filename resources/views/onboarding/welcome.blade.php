@extends('template')

@section('title')
Bienvenue !
@endsection

@push('body-classes')
bg--white
@endpush

@section('content')
<div class="container speech-bubble">
	<main class="onboarding unboard--welcome">

			<h1 class="onboarding__title onboarding__title--big">
				Salut à toi jeune Rösti !
			</h1>

			<p>
				Bienvenue au <mark>meilleur jeu de Romandie</mark>, Rösti Quiz !<br>
				Merci d'avoir vérifié ton adresse!<br>
				<br>
				En tant que présentateur, c’est ma mission de te guider à travers ton <mark>aventure röstienne</mark>... <br>
				<br>
				Allons-y !
			</p>


		<div class="bottombar">
		<a class="btn btn--primary" href="{{route('onboardingAvatar')}}">Suivant</a>
		</div>
	</main>
</div>

<x-presenter></x-presenter>

@endsection
