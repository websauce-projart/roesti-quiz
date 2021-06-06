@extends('gameloop/template_gameloop')

@section('title')
ENDGAME
@endsection

@section('content')
<form action="{{ route('displayGame') }}" method="POST">
@csrf
    <strong>BRAVO LE VEAU!</strong>
    <ul>
        <li><strong>Bonnes réponses : </strong> {{$count}}/10</li>
        <li><strong>Temps total : </strong> {{$time}} secondes</li>
        <li><strong>Score final : </strong> {{$score}}</li>
    </ul>
    <input type="hidden" name="game_id" value="{{ $game->id }}">
    <input type="submit" value="Score général">
</form>
@endsection