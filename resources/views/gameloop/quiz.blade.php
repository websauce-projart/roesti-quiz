@extends('template')

@section('title')
    Quiz
@endsection

@section('content')

<div id="cards">
		<div class="cards-container">
        <cards-app></cards-app>
		</div>
</div>>
<script src="js/app.js"></script>


    <form action="{{ route('postquiz', ['game_id' => $game_id, 'round_id' => $round_id, 'result_id' => $result_id]) }}"
        method="POST">
        @csrf
        @foreach ($questions as $question)
            <div>
                <strong>{{ $question->label }}</strong>
                <div>
                    Vrai<input type="checkbox" name="{{ $question->id }}">
                </div>
            </div>
        @endforeach
        <div>
            <x-input-submit label="Envoyer"></x-input-submit>
        </div>
    </form>
@endsection
