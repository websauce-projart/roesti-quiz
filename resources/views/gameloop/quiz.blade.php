@extends('template')

@section('title')
    Quiz
@endsection

@section('content')

	<div class="container">

		<header class="header header--cards">
			<nav class="topnav">
				<a class="icon-arrow-left" href="{{ route("results", [$game_id]) }}" aria-label="Retour"></a>
			</nav>
			<div class="timer">timer</div>
		</header>

		<div id="cards">
			<div class="cards-container">
			<cards-app :datas="{{ $questions }}"></cards-app>
			</div>
		</div>

	<form action="{{ route('postquiz', ['game_id' => $game_id, 'round_id' => $round_id, 'result_id' => $result_id]) }}" method="POST" class="no-display" id="quizForm">
        @csrf
        @foreach ($questions as $question)
		  	<input type="checkbox" id="{{ $question->id }}">
        @endforeach
        <div>
            <x-input-submit label="Envoyer"></x-input-submit>
        </div>
	</form>

</div>

@endsection

