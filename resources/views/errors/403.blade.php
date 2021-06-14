@extends('template')

@section('title', "Accès interdit")

@push('body-classes', "bg--white")

@section('content')
<div class="container speech-bubble">

	<div class="errorPage">
		<h1>Erreur 403</h1>

		<div class="errorPage--message">
			La page demandée t'es inaccessible. <br>
			Désolé mon p’tit rösti !
		</div>

		<div class="bottombar">
			<a href="{{ route("login") }}" class="btn btn--primary">Retour à l'accueil</a>
		</div>
	</div>

</div>

<x-presenter mood="404"></x-presenter>

@endsection
