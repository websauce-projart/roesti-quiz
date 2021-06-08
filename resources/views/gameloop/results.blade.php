@extends('gameloop/template_gameloop')

@section('title')
    Quiz
@endsection

@section('content')

<div id="results"></div>
    <script src="js/app.js"></script>
    {{ $user->pseudo }} vs. {{ $opponent->pseudo }}<br>
    @foreach ($rounds as $round)
        <form action="" method="POST">
            @csrf

            <input type="hidden" name="round_id" value="{{ $round['id'] }}">
            <input type="submit">
            [Round {{ $loop->index + 1 }}: {{ $round['category'] }}]

            @if ($round['results'][0] == null)
                À ton tour!
            @else
                {{ $round['results'][0] }}
            @endif

            –

            @if ($round['results'][1] == null)
                En attente...
            @else
                {{ $round['results'][1] }}
            @endif

            </input>
        </form>
    @endforeach

    <hr>

    @if($game->active_user_id == $user->id)
    <a href="{{ route('play', [$game]) }}">
        @if(($lastRound->results()->count()) < 2)
        C'est parti mon röesti!
        @else
        Revanche
        @endif
    </a>
    @else
        <a href="{{ route('home') }}">Retour au menu</a>
    @endif

@endsection
