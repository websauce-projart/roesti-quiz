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

            <div>

                😊 Merci de confirmer votre adresse email pour pouvoir vous accéder au RöstiQuiz! 😊

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn--primary btn-link p-0 m-0 align-baseline">si ta perdu ton
                        mail
                        clic
                        ici
                        lol</button>
                </form>


                @if ($errors->has('email-resent'))
                📧 Un nouveau mail de verification vous a été envoyé! 📧
                @endif
            </div>
        </main>
    </div>
</body>

@endsection