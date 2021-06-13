@extends('template')

@section('title')
Profil
@endsection

@section('content')
<div class="container">

	<header class="header header--home">
		<nav class="topnav">
			<a href="{{ route('results', [$game_id]) }}" class="icon-arrow-left" aria-label="Retour"></a>
		</nav>
		<img class="logo" src="{{ asset("img/logo_v2_1.svg") }}" alt="Rösti Quiz" />
	</header>

	<main class="profile">
		<section class="profile__avatar">
			<div class="profile__avatar__image">
				<x-avatar posePath="{{$data['user']->getPosePath()}}" eyePath="{{$data['user']->getMouthPath()}}" mouthPath="{{$data['user']->getEyePath()}}"></x-avatar>
			</div>
		</section>

		<section class="profile__info">
			<h1 class="profile__info__pseudo">{{$data['user']->pseudo}}</h1>
			<div class="profile__info__score">{{$data['score']['titleScore']}} · {{$data['score']['points']}} points</div>
		</section>

	</main>

</div>
@endsection
