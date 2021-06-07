@extends('home/template_home')

@section('title')
    RöstiQuiz - Accueil
@endsection

@section('contenu')

    <div id="home"></div>
    <script src="js/app.js"></script>


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
                    @if ($gamedata['game']->active_user_id == $gamedata['user']->id)
                        <div>
                            <p>À toi de jouer</p>
                            <form method="POST" action="{{ route('getresults') }}" accept-charset="UTF-8">
                                @csrf
                                <input type="hidden" name="game_id" value="{{$gamedata['game']->id}}">
                                <input type="submit" value="->">
                            </form>
                        </div>
                    @else
                        <div>
                            <p>N'a pas encore relevé ton défi...</p>
                        </div>
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
