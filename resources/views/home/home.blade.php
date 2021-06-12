@extends('template')

@section('title')
    Accueil
@endsection

@push('body-classes')
bg--white
@endpush

@section('content')
<div class="container speech-bubble">

		<header class="header header--home">
			<nav class="topnav">
				<a href="{{ route('profile', [$user_id]) }}" class="icon-user" arial-label="Profile"></a>
			</nav>
			<img class="logo" src="{{ asset("img/logo_v2_1.svg") }}" alt="Rösti Quiz" />
		</header>

		<main>
			<div id="vue_home">
				<home data_url='api/home'></home>
			</div>

			<form class="bottombar" method="POST" action="" accept-charset="UTF-8">
					@csrf
					<x-input-submit label="Nouvelle partie"></x-input-submit>
			</form>
		</main>

</div>

@endsection
