@extends('template')

@section('title')
	 Mot de passe oublié
@endsection

@section('content')
<div class="container">
    <header>
		 <nav class="topnav">
			<a href="{{ route('login') }}" class="icon-arrow-left" aria-label="Retour"></a>
			<h1 class="pageTitle">Mot de passé oublié</h1>
		 </nav>
    </header>

    @if (Session::has('status'))
    <!-- forgot password (AuthC.) -->
    <div>{{ Session::get('status') }}</div>
    @endif

    @if (Session::has('email'))
    <!-- forgot password (AuthC.) -->
    <div>{{ Session::get('email') }}</div>
    @endif

    <form action="" method="post" class="form form--center">
        @csrf

		  <div class="form__row">
			  <p>Ça arrive à tout le monde d'oublier son mot de passe. Ne t'en fais pas, on est là pour toi !</p>
			  <p>Écris juste ton adresse e-mail et on se charge de t'envoyer un lien de réinitialisation dans ta boîte mail !</p>
		  </div>

        <div class="form__row">
            <x-input-text label="Adresse e-mail" id="email" placeholder="Entrez votre adresse e-mail..." icon="envelope">
            </x-input-text>
            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>

        <div class="form__row">
            <x-input-submit label="Envoyer"></x-input-submit>
        </div>

    </form>
</div>
@endsection
