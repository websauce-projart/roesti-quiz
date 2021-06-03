@extends('gameloop/template_gameloop')

@section('title')
    Quiz
@endsection

@section('content')

    User1: {{ $users_id[0] }} – User2: {{ $users_id[1] }}<br>
    {{ $category_title }} - {{ session('game_id') }}

@endsection
