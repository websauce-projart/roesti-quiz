@extends('template')

@section('title')
Quiz
@endsection

@section('content')
<div class="speech-bubble">
    <div id="cards">
        <div class="cards-container">
            <cards-app :datas="{{ $questions }}"></cards-app>
        </div>
    </div>
</div>

<form action="{{ route('postquiz', ['game_id' => $game_id, 'round_id' => $round_id, 'result_id' => $result_id]) }}"
    method="POST" class="no-display" id="quizForm">
    @csrf
    @foreach ($questions as $question)
    <div>
        <strong>{{ $question->label }}</strong>
        <div>
            Vrai<input type="checkbox" id="{{ $question->id }}">
        </div>
    </div>
    @endforeach
    <div>
        <x-input-submit label="Envoyer"></x-input-submit>
    </div>
</form>


@endsection