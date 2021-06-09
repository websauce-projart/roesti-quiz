@extends('template')

@section('title')
    Quiz
@endsection

@section('content')

    <body>
        <nav class="container topnav topnav--right">
            <a href="{{ route('home') }}">X</a>
        </nav>

        <main>
            <section class="container">
                <div class="results">
                    <div class="results__player">
                        <div class="results__player__img">
                            <img src="https://picsum.photos/id/1025/80" alt="">
                        </div>
                        <div class="results__player__pseudo">{{ $user->pseudo }}</div>
                        <div class="results__player__score">1</div>
                    </div>

                    <span class="results__versusLabel" aria-label="Versus">VS</span>

                    <div class="results__player">
                        <div class="results__player__img">
                            <img src="https://picsum.photos/id/1003/80" alt="">
                        </div>
                        <div class="results__player__pseudo">{{ $opponent->pseudo }}</div>
                        <div class="results__player__score">0</div>
                    </div>
                </div>
            </section>

            <section class="roundBadge__container">
                @foreach ($rounds as $round)

                    <a class="roundBadge" data-index="{{ $loop->index + 1 }}"
                        href="{{ route('round_history', [$game, $round['id']]) }}">
                        <div class="roundBadge__score">
                            @if ($round['results'][0] == null)
                                À ton tour
                            @else
                                {{ $round['results'][0] }} pts
                            @endif
                        </div>
                        <div class="roundBadge__category">
                            {{ $round['category'] }}
                        </div>

                        <div class="roundBadge__score">
                            @if ($round['results'][1] == null)
                                En attente
                            @else
                                {{ $round['results'][1] }} pts
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
                        @if ($lastRound->results()->count() < 2)
                            C'est parti mon rösti!
                        @else
                            Revanche
                        @endif
                    </a>
                @else
                    <a class="btn btn--primary" href="{{ route('home') }}">Retour au menu</a>
                @endif
            </div>

        </main>
    </body>
@endsection
