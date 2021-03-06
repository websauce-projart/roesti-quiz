@extends('template')

@section('title')
Quiz
@endsection

@push('body-classes')
pattern-body-fix
@endpush

@section('content')

<div class="container">
    <nav class="topnav">
        <a href="{{ route('home') }}" class="icon-home"></a>
    </nav>
</div>

<main>
    <section class="container">
        <div class="results">
            <div class="results__player">
                <div class="results__player__img">
                    <x-avatar posePath="{{ $user->getPosePath() }}" eyePath="{{ $user->getMouthPath() }}"
                        mouthPath="{{ $user->getEyePath() }}"></x-avatar>
                </div>
                <div class="results__player__pseudo">{{ $user->pseudo }}</div>
                <div class="results__player__score">{{ $userWonRounds }}</div>
            </div>

            <span class="results__versusLabel" aria-label="Versus">VS</span>

            <div class="results__player">
                <div class="results__player__img">
                    <a href="{{ route('profile', [$opponent->id]) }}">
                        <x-avatar posePath="{{ $opponent->getPosePath() }}" eyePath="{{ $opponent->getMouthPath() }}"
                            mouthPath="{{ $opponent->getEyePath() }}"></x-avatar>
                    </a>
                </div>
                <div class="results__player__pseudo">{{ $opponent->pseudo }}</div>
                <div class="results__player__score">{{ $opponentWonRounds }}</div>
            </div>
        </div>
    </section>

    <section class="roundBadge__container">
        @foreach ($rounds as $round)

        <a
		  	class="roundBadge
		  	{{
			  	$game->active_user_id == $user->id &&
				$lastRound->id == $round->id &&
				$round->results()->get()->count() != 2 ||
				!$user->hasResult($round->id)
				? 'disabled' : ''
			}}"
			data-index="{{ count($rounds) - $loop->index }}"
         href="{{ route('round_history', [$game, $round->id]) }}"
			>

            <div class="roundBadge__score">
                @if ($game->active_user_id == $user->id &&
                $lastRound->id == $round->id &&
                $round->results()->get()->count() != 2)
                	?? ton tour
                @elseif($game->active_user_id == $user->id && $lastRound->id == $round->id &&
                $round->results()->get()->count() == 2)
               	 {{ $round->getScore($user->id) }}
                @elseif($game->active_user_id != $user->id && $lastRound->id == $round->id &&
                $round->results()->get()->count() == 0)
               	 En attente
                @elseif($game->active_user_id != $user->id && $lastRound->id == $round->id &&
                $round->results()->get()->count() > 0)
               	 {{ $round->getScore($user->id) }}
                @else
               	 {{ $round->getScore($user->id) }}
                @endif
            </div>

            <div class="roundBadge__category">
                {{ $round->getCategory()->title }}
            </div>

            <div class="roundBadge__score">
                @if ($game->active_user_id == $opponent->id &&
                $lastRound->id == $round->id &&
                $round->results()->get()->count() != 2)
                ?? son tour
                @elseif($game->active_user_id != $opponent->id && $lastRound->id == $round->id &&
                $round->results()->get()->count() == 0)
                En attente
                @elseif($game->active_user_id != $opponent->id && $lastRound->id == $round->id &&
                $round->results()->get()->count() > 0)
                {{ $round->getScore($opponent->id) }}
                @else
                {{ $round->getScore($opponent->id) }}
                @endif
            </div>
        </a>

        @endforeach

        <div class="roundBadge--phantom">
            {{-- This is just to avoid the last item to go behind the bottombar button. Maybe there is a better way with CSS; and if you know how, please tell me. --}}
        </div>
    </section>


    <div class="bottombar bg--white">
        @if ($game->active_user_id == $user->id)
        <a class="btn btn--primary" href="{{ route('play', [$game]) }}">
            @if ($lastRound->results()->count() < 2) C'est parti mon r??sti! @else Revanche @endif </a>
                @else
                <a class="btn btn--primary" href="{{ route('home') }}">Retour ?? l'accueil</a>
                @endif
    </div>

</main>

@endsection
