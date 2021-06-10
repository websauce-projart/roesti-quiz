@extends('template')

@section('title')
ENDGAME
@endsection

@section('content')
    <strong>BRAVO LE VEAU!</strong>
    <ul>
        <li><strong>Bonnes réponses : </strong> {{$count}}/10</li>
        <li><strong>Temps total : </strong> {{$time}} secondes</li>
        <li><strong>Score final : </strong> {{$score}}</li>
    </ul>
    <a href="{{ route('results', [$game]) }}">Score général</a>
@endsection