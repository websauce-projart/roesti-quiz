@extends('template')

@section('title')
 Résultat
@endsection

@push('body-classes')
bg--white
@endpush

@section('content')
<main class="container speech-bubble">

	<nav class="topnav">
		<a href="{{ route('home') }}" class="icon-close"></a>
	</nav>

	<div class="section">
		<div class="endgame__sentence">
			{{$sentence}}
		</div>

		<div class="endgame__score__container">
			<ul class="endgame__score">
				<li><strong>Bonnes réponses : </strong> {{$count}}/10</li>
				<li><strong>Temps total : </strong> {{$time}} secondes</li>
				<li><strong>Score final : </strong> {{$score}} points</li>
			</ul>
		</div>

		<div class="center">
			<a href="{{ route("round_history", [$game, $round_id]) }}">Voir mes réponses</a>
		</div>
	</div>

	<div class="bottombar">
  	  <a class="btn btn--primary" href="{{ route('results', [$game]) }}">Score général</a>
	</div>

</main>

<x-presenter></x-presenter>

@endsection
