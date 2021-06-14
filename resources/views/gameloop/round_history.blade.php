@extends('template')

@section('title')
Historique des réponses
@endsection

@push('body-classes')
bg--white
@endpush

@section('content')
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
                <div class="history__answer">
                    @if ($question->answer_boolean)
                    Vrai
                    @else
                    Faux: {{ $question->answer_label }}
                    @endif
                </div>

            </div>

            <div class="history__playersContainer">
                <div class="history__player" aria-label="{{ $user['object']->pseudo }}">
                    <x-avatar posePath="{{ $user['object']->getPosePath() }}" eyePath="{{ $user['object']->getMouthPath() }}" mouthPath="{{ $user['object']->getEyePath() }}"></x-avatar>

                    @if (isset($user['answers'][$loop->index]['user_answer']))
                    <div class="history__player__answer">
                        {{ $user['answers'][$loop->index]['user_answer'] ? 'Vrai' : 'Faux' }}
                    </div>
                    @else
                    <div class="history__player__answer">?</div>
                    @endif
                </div>

                <div class="history__player history__player--opponent" aria-label="{{ $opponent['object']->pseudo }}">
                    <x-avatar posePath="{{ $opponent['object']->getPosePath() }}" eyePath="{{ $opponent['object']->getMouthPath() }}" mouthPath="{{ $opponent['object']->getEyePath() }}"></x-avatar>

                    @if (isset($opponent['answers'][$loop->index]['user_answer']))
                    <div class="history__player__answer">
                        {{ $opponent['answers'][$loop->index]['user_answer'] ? 'Vrai' : 'Faux' }}
                    </div>
                    @else
                    <div class="history__player__answer">?</div>
                    @endif

                </div>
            </div>

        </div>
        @endforeach

        <div id="arrow__up" class="btn btn--tertiary bg--lightblue center margin-small-bottom">
            <i class="icon-arrow-left rotate-icon"></i>
        </div>

    </div>
</div>
@endsection

@push('script')
<script>
    const upButton = document.getElementById('arrow__up');
    const goTop = () => {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    upButton.addEventListener('click', goTop);
</script>
@endpush