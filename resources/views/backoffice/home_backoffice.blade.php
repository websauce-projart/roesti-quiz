@extends('template')

@section('title')
	 Backoffice: Home
@endsection

@section('content')
<div class="container">
	<x-backoffice-nav></x-backoffice-nav>

	<h1>Backoffice des administrateurs</h1>
	<p>Bienvenue dans l'espace de gestion destiné aux administrateurs.</p>

	<ul>
		<li><strong>Home:</strong> C'est la page d'accueil, celle-là même.
		</li>
		<li><strong>Utilisateurs:</strong> Vous pouvez modifier et supprimer des utilisateurs depuis ici</li>
		<li><strong>Questions:</strong> Vous pouvez créer une nouvelle question et en choisir la catégorie</li>
		<li><strong>Logout:</strong> Pour se déconnecter</li>
	</ul>

	<h2>Informations</h2>

	<ul>
		<li>Un administrateur ne peut pas jouer au quiz. Il n'est là que pour faire de la gestion.</li>
	</ul>

</div>
@endsection
