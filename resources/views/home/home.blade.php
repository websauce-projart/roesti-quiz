@extends('home/template_home')

@section('title')
RöstiQuiz - Acceuil
@endsection

@section('contenu')

    @if(sizeof($data) == 0)
        <div>
            Tu n'as encore aucune partie en cours.

            Clique sur nouvelle partie pour un max de fun !
        </div>
    @else
    <div>
        @if(sizeof($data) == 1)
            <p>Partie en cours</p>
        @else
            <p>Parties en cours</p>
        @endif
        
        @foreach ($data as $gamedata)
            <div>
            {{$gamedata['opponent']->pseudo}}
            @if($gamedata['game']->active_user_id == $gamedata['user']->id)
                <div>
                    <p>À toi de jouer</p>
                    <form method="POST" action="{{url('/')}}" accept-charset="UTF-8">
                        @csrf
                        @method('PUT')
                        <input class="" type="submit" value="->">
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
        <form method="POST" action="{{url('/newgame')}}" accept-charset="UTF-8">
            @csrf
            <input class="" type="submit" value="Nouvelle Partie">
        </form>
    </div>
@endsection