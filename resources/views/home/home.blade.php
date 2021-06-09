@extends('home/template_home')

@section('title')
RöstiQuiz - Accueil
@endsection

@section('contenu')
<div class="speech-bubble">
   <!-- <div id="app">
		<div class="cards-container">
        <cards-app></cards-app>
		</div>
    </div>
    <script src="js/app.js"></script> -->

    <div class="container--game">
        @if (sizeof($data) == 0)
        <div>
            Tu n'as encore aucune partie en cours.

            Clique sur nouvelle partie pour un max de fun !
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
            <div class="home--game">
                <span class="home--game--pseudo">{{ $gamedata['opponent']->pseudo }}</span>
                <span class="home--game--info">À toi de jouer</span>
                <span class="home--game--play">
                    <span class="home--game--play--text">-></span>
                </span>
                <a href="{{ route('join', [$gamedata['game']]) }}" class="home--game--submit"></a>
            </div>
            @endif
        @endforeach
        @foreach ($data as $gamedata)
            @if ($gamedata['game']->active_user_id !== $gamedata['user']->id)
            <div class="home--game home--game--wait">
                <span class="home--game--pseudo">{{ $gamedata['opponent']->pseudo }}</span>
                <span class="home--game--info">N'a pas encore relevé ton défi...</span>
                <a href="{{ route('join', [$gamedata['game']]) }}" class="home--game--submit"></a>
            </div>
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
