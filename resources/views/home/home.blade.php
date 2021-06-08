@extends('home/template_home')

@section('title')
RöstiQuiz - Accueil
@endsection

@section('contenu')
<div class="speech-bubble">
    <!-- <div id="app">
        <home :classes='@json($data)'></home>
    </div>
    <script src="js/app.js"></script> -->

    <div class="container--game">
        @if (sizeof($data) == 0)
        <div>
            Tu n'as encore aucune partie en cours.

            Clique sur nouvelle partie pour un max de fun !
        </div>
        @else
        <h1 class="home--game--h1">
            @if (sizeof($data) == 1)
            Partie en cours
            @else
            Parties en cours
            @endif
        </h1>


        @foreach ($data as $gamedata)
            @if ($gamedata['game']->active_user_id == $gamedata['user']->id)
            <x-form-game-play value="{{$gamedata['game']->id}}" pseudo="{{ $gamedata['opponent']->pseudo }}"></x-form-game-play>
            @endif
        @endforeach
        @foreach ($data as $gamedata)
            @if ($gamedata['game']->active_user_id !== $gamedata['user']->id)
            <x-form-game-wait value="{{$gamedata['game']->id}}" pseudo="{{ $gamedata['opponent']->pseudo }}"></x-form-game-wait>
            @endif
        @endforeach
        @endif
    </div>
</div>
<form method="POST" action="" accept-charset="UTF-8">
    @csrf
    <x-input-submit label="Nouvelle partie"></x-input-submit>
</form>
@endsection