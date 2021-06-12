@extends('template')

@section('title')
Profil
@endsection

@section('content')
<div class="container">

	<header class="header header--home">
		<nav class="topnav">
			<a href="{{ route('home') }}" class="icon-arrow-left" aria-label="Retour"></a>
		</nav>
		<img class="logo" src="{{ asset("img/logo_v2_1.svg") }}" alt="Rösti Quiz" />
	</header>

	<main class="profile">
		<section class="profile__avatar">
			<div class="profile__avatar__image">
				<x-avatar posePath="{{$data['user']->getPosePath()}}" eyePath="{{$data['user']->getMouthPath()}}" mouthPath="{{$data['user']->getEyePath()}}"></x-avatar>

				<div class="profile__avatar__editButton">
					<a href="{{route('updateAvatar', [$data['user']->id])}}" class="icon-edit-pencil" aria-label="Éditer l'avatar"></a>
				</div>

			</div>
		</section>

		<section class="profile__info">
			<h1 class="profile__info__pseudo">{{$data['user']->pseudo}}</h1>
			<div class="profile__info__score">{{$data['score']['titleScore']}} · {{$data['score']['points']}} points</div>
		</section>

		<section class="profile__actions">
			<a class="btn btn--tertiary" href="{{ route('updatePasswordForm', [$data['user']->id]) }}">Changer de mot de passe</a>
			<a class="btn btn--tertiary" href="{{ route("logout") }}">Se déconnecter</a>
			<form method="post" action="" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">
				@csrf
				<button type="submit">Supprimer mon compte</button>
			</form>
		</section>

	</main>

</div>
@endsection
