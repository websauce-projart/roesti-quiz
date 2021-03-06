@extends('template')

@section('title')
Backoffice
@endsection

@push('body-classes')
pattern-stop
@endpush

@section('content')
<div class="container">
	<x-backoffice-nav></x-backoffice-nav>

	<h1>Backoffice des administrateurs</h1>
	<p>Bienvenue dans l'espace de gestion destiné aux administrateurs.</p>

	<ul>
		<li><strong>Home:</strong> C'est la page d'accueil, celle-là même.</li>
		<li><strong>Utilisateurs:</strong> Vous pouvez modifier et supprimer des utilisateurs.</li>
		<li><strong>Administrateur:</strong> Vous pouvez créer, modifier et supprimer des administrateurs.</li>
		<li><strong>Questions:</strong> Vous pouvez créer, modifier et supprimer des questions.</li>
		<li><strong>Logout:</strong> Pour se déconnecter</li>
	</ul>

	<h2>Informations</h2>

	<ul>
		<li>Le backoffice a été pensé pour une utilisateur sur ordinateur. La version mobile est fonctionnelle mais pas optimisée</li>
		<li>Un administrateur ne peut pas jouer au quiz. Il n'est là que pour faire de la gestion d'utilisateur et de questions.</li>
	</ul>

</div>
@endsection
