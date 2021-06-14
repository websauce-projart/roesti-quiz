@extends('template')

@section('title')
	 Réinitialiser le mot de passe
@endsection

@section('content')
<div class="container">

    

	 <header>
		<nav class="topnav">
		  <a href="{{ route('login') }}" class="icon-arrow-left" aria-label="Retour"></a>
		  <h1 class="pageTitle">Réinitialiser le mot de passe</h1>
		</nav>
	</header>

    @if (Session::has('email'))
    <div class="status"><i class="icon-information"></i>{{ Session::get('email') }}aaaa</div>
    @endif

    <form action="" class="form form--center" method="post">
        @csrf

        <div class="form__row">
            <x-input-text label="Adresse e-mail" id="email" placeholder="Entrez votre adresse e-mail..." icon="envelope" value="{{ old('email') }}">
            </x-input-text>
            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
        </div>

        <div class="form__row">
            <x-input-text label="Nouveau mot de passe" id="password" placeholder="Entrez votre mot de passe..."
                type="password" icon="lock-closed"></x-input-text>
            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <div class="form__row">
            <x-input-text label="Confirmation du nouveau mot de passe" id="password_confirmation"
                placeholder="Confirmez votre mot de passe..." type="password" icon="lock-closed"></x-input-text>
            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
        </div>

        <input id="token" name="token" type="hidden" value="{{$token}}">

        <div class="form__row">
            <x-input-submit label="Modifier mon mot de passe!"></x-input-submit>
        </div>

        <div class="form__row">
            @if (Session::has('status'))
            {{ Session::get('status') }}
            @endif

            @if (Session::has('email'))
            {{ Session::get('email') }}
            @endif
        </div>
    </form>
</body>

</html>
