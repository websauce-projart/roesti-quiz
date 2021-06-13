@extends('template')

@section('title')
    Historique des réponses
@endsection

@push('body-classes')
bg--white
@endpush

@section('content')

    <body class="bg--white">
        <div class="container">
            <nav class="topnav">
                <a href="{{ route('results', $game_id) }}" class="icon-arrow-left" aria-label="Retour"></a>
                <h1 class="pageTitle">Historique des réponses</h1>
            </nav>

            <div class="history__container">
                @foreach ($questions as $question)
                    <div class="history">

                        <div class="history__question">
                            {{ $question->label }}
                            @if ($question->answer_label)
                                <div class="history__answer">
                                    @if ($question->answer_boolean)
                                        Vrai
                                    @else
                                        Faux: {{ $question->answer_label }}
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="history__playersContainer">
                            <div class="history__player" aria-label="{{ $user['object']->pseudo }}">
                                <x-avatar posePath="{{ $user['object']->getPosePath() }}"
                                    eyePath="{{ $user['object']->getMouthPath() }}"
                                    mouthPath="{{ $user['object']->getEyePath() }}"></x-avatar>

                                @if (isset($user['answers'][$loop->index]['user_answer']))
                                    <div
                                        class="iconBadge iconBadge--small {{ $user['answers'][$loop->index]['user_answer'] ? 'iconBadge--true icon-checkmark' : 'iconBadge--false icon-close' }}">
                                    </div>
                                @else
                                    <div class="iconBadge iconBadge--small iconBadge--unanswered icon-question-mark"></div>
                                @endif
                            </div>

                            <div class="history__player" aria-label="{{ $opponent['object']->pseudo }}">
                                <x-avatar posePath="{{ $opponent['object']->getPosePath() }}"
                                    eyePath="{{ $opponent['object']->getMouthPath() }}"
                                    mouthPath="{{ $opponent['object']->getEyePath() }}"></x-avatar>


                                @if (isset($opponent['answers'][$loop->index]['user_answer']))
                                    <div
                                        class="iconBadge iconBadge--small {{ $opponent['answers'][$loop->index]['user_answer'] ? 'iconBadge--true icon-checkmark' : 'iconBadge--false icon-close' }}">
                                    </div>
                                @else
                                    <div class="iconBadge iconBadge--small iconBadge--unanswered icon-question-mark"></div>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        @endsection
    </div>
</body>
