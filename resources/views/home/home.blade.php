@extends('template')

@section('title')
    Accueil
@endsection

@section('content')


    <div id="main-nav" class="container">
        <header class="header header--login">
            <nav class="topnav topnav--left">
                <main-nav-button></main-nav-button>
            </nav>
            <img class="logo" src="img/logo_v2_1.svg" alt="Rösti Quiz" />
        </header>

        <main>
            <div class="speech-bubble">
                <div id="vue_home">
                    <home data_url='/api/home'></home>
                </div>
            </div>

            <form class="bottombar" method="POST" action="" accept-charset="UTF-8">
                @csrf
                <x-input-submit label="Nouvelle partie"></x-input-submit>
            </form>
        </main>

        <main-nav-content v-if="false"></main-nav-content>

    </div>

@endsection
