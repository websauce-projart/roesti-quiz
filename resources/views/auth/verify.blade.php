@extends('template')

@section('title')
Vérifie ton email
@endsection

@section('content')

<body>
    <div class="container">
        <header class="header header--login">
            <img class="logo" src="img/logo_v2_1.svg" alt="Rösti Quiz" />
        </header>

        <main>
            <nav class="container topnav topnav--right">
                <a href="{{ route('logout') }}">Retour au login</a>
            </nav>

            <div>

                @if (Session::has('ok'))
                <!-- email resent (AuthC.) -->
                <div>{{ Session::get('ok') }}</div>
                @endif

                Merci de confirmer votre adresse email pour pouvoir vous accéder au RöstiQuiz!

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn--primary">Renvoyer un mail de vérification</button>
                </form>



            </div>
        </main>
    </div>
</body>

@endsection