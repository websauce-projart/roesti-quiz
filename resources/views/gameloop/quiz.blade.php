@extends('template')

@section('title')
Quiz
@endsection

@push('body-classes', "pattern-freeze")

@section('content')

	<div class="container">

		<header class="header header--cards">
			<div id="timer" class="center">
				<timer class="timer"></timer>
			</div>
		</header>

		<div id="cards">
			<div class="cards-container">
			<cards-app :datas="{{ $questions }}"></cards-app>
			</div>
		</div>

	<form action="{{ route('postquiz', ['game_id' => $game_id, 'round_id' => $round_id, 'result_id' => $result_id]) }}" method="POST" class="no-display" id="quizForm">
        @csrf
        @foreach ($questions as $question)
		  	<input type="checkbox" name="{{ $question->id }}" id="{{ $question->id }}">
        @endforeach
         <x-input-submit label="Envoyer"></x-input-submit>
	</form>

</div>
<script src="/js/app.js"></script>
@endsection
