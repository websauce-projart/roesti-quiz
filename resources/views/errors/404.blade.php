@extends('template')

@section('title', "Page non trouvée")

@push('body-classes', "bg--white")

@section('content')
<div class="container speech-bubble">

	<div class="errorPage">
		<h1>Erreur 404</h1>

		<div class="errorPage--message">
			La page demandée est introuvable. <br>
			Désolé mon p’tit rösti !
		</div>

		<div class="bottombar">
			<a href="{{ route("login") }}" class="btn btn--primary">Retour à l'accueil</a>
		</div>
	</div>

</div>

<x-presenter mood="404"></x-presenter>

@endsection
