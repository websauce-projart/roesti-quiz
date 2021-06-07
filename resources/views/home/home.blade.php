@extends('home/template_home')

@section('title')
    RöstiQuiz - Accueil
@endsection

@section('contenu')
    <!-- <div id="app">
        <home :classes='@json($data)'></home>
    </div>
    <script src="js/app.js"></script> -->


    @if (sizeof($data) == 0)
        <div>
            Tu n'as encore aucune partie en cours.

            Clique sur nouvelle partie pour un max de fun !
        </div>
    @else
        <div>
            @if (sizeof($data) == 1)
                <h1>Partie en cours</h1>
            @else
                <h1>Parties en cours</h1>
            @endif

            @foreach ($data as $gamedata)
                <div>
                    @if ($gamedata['game']->active_user_id == $gamedata['user']->id)
                            <x-form-game-play value="{{$gamedata['game']->id}}" pseudo="{{ $gamedata['opponent']->pseudo }}"></x-form-game-play>
                    @endif
                </div>
            @endforeach
            @foreach ($data as $gamedata)
                <div>
                    @if ($gamedata['game']->active_user_id !== $gamedata['user']->id)
                            <x-form-game-wait value="{{$gamedata['game']->id}}" pseudo="{{ $gamedata['opponent']->pseudo }}"></x-form-game-wait>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
    <div>
        <form method="POST" action="" accept-charset="UTF-8">
            @csrf
            <x-input-submit label="Nouvelle partie"></x-input-submit>
        </form>
    </div>
@endsection
