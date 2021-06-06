@extends('gameloop/template_gameloop')

@section('title')
    Quiz
@endsection

@section('content')

    {{ $users[0]['pseudo'] }} vs. {{ $users[1]['pseudo'] }}<br>

    @foreach ($rounds as $round)
        <div>
            [Round {{ $loop->index + 1 }}: {{ $round['category'] }}]
            {{ $round['results'][0] }} –
            {{ $round['results'][1] }}
        </div>
    @endforeach

    <hr>

    <a href="{{ route('quiz') }}">play</a>

@endsection
