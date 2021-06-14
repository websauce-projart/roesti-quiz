@extends('template')

@section('title')
Vérifie ton email
@endsection

@section('content')

<div class="container">

    <nav class="topnav">
        <a href="{{ route('logout') }}" class="icon-arrow-left"></a>
        <h1 class="pageTitle">Vérification du compte</h1>
    </nav>

    <main>

        @if (Session::has('ok'))
        <!-- email resent (AuthC.) -->
        <div class="status"><i class="icon-information"></i>{{ Session::get('ok') }}</div>
        @endif

        <form class="form form--center" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <div class="form__row">
                <p>Merci de confirmer votre adresse email pour pouvoir vous accéder au RöstiQuiz!</p>
            </div>

            <div class="form__row">
                <button type="submit" class="link">Renvoyer un mail de vérification</button>
            </div>
        </form>

    </main>
</div>

@endsection