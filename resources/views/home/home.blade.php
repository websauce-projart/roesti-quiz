@extends('home/template_home')

@section('title')
RöstiQuiz - Accueil
@endsection

@section('contenu')

@if (sizeof($data) == 0)
<div>
    Tu n'as encore aucune partie en cours.

    Clique sur nouvelle partie pour un max de fun !
</div>
@else
<div>
    @if (sizeof($data) == 1)
    <p>Partie en cours</p>
    @else
    <p>Parties en cours</p>
    @endif

    @foreach ($data as $gamedata)
    <div>
        <strong>{{ $gamedata['opponent']->pseudo }}</strong>
        <div>
            <p>
                @if ($gamedata['game']->active_user_id == $gamedata['user']->id)
                À toi de jouer
                @else
                N'a pas encore relevé ton défi...
                @endif
            </p>
            <form method="POST" action="{{ route('redirectFromHome') }}" accept-charset="UTF-8">
                @csrf
                <input type="hidden" name="game_id" value="{{$gamedata['game']->id}}">
                <input type="submit" value="->">
            </form>
        </div>


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