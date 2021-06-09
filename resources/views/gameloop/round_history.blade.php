@extends('template')

@section('title')
    Historique des réponses
@endsection

@section('content')
    <h1>Historique des réponses</h1>
    <a href="{{ route('join', $game_id) }}">Retour</a>

    @foreach ($questions as $question)
        <div class="card">

            <div>
                {{ $user['object']->pseudo }} a répondu:
                @isset($user['answers'])
                    @if ($user['answers'][$loop->index]['user_answer'])
                        vrai
                    @else
                        faux
                    @endif
                @endisset

            </div>

            <div>
                {{ $question->label }}
                @if ($question->answer_label)
                    <br><small>{{ $question->answer_label }}</small>
                @endif
            </div>

            <div>
                {{ $opponent['object']->pseudo }}
                @isset($opponent['answers'])
                    @if ($opponent['answers'][$loop->index]['user_answer'])
                        vrai
                    @else
                        faux
                    @endif
                @endisset
            </div>


        </div>
    @endforeach

@endsection
