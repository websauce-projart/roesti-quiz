@extends('template')

@section('title')
Modifier le mot de passe
@endsection

@section('content')
<div class="container">

    

	 <header class="header">
		<nav class="topnav">
			<a href="{{ route('profile', [$user_id]) }}" class="icon-arrow-left" aria-label="Retour"></a>
			<h1 class="pageTitle">Modifier le mot de passe</h1>
		</nav>
	</header>

    @if (Session::has('ok'))
    <!-- updatePassword (AuthC.) -->
    <div class="status"><i class="icon-checkmark"></i>{{ Session::get('ok') }}</div>
    @endif

    @if (Session::has('error'))
    <!-- updatePassword (AuthC.) -->
    <div class="status"><i class="icon-checkmark"></i>{{ Session::get('error') }}</div>
    @endif

     <form class="form form--center" action="" method="post">

           @csrf
            <div class="form__row">
            	<x-input-text label="Ancien mot de passe" id="oldpassword" placeholder="Entrez votre ancien mot de passe" type="password"></x-input-text>
            	{!! $errors->first('oldpassword', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form__row">
            	<x-input-text label="Nouveau mot de passe" id="newpassword" placeholder="Entrez votre nouveau mot de passe" type="password"></x-input-text>
            	{!! $errors->first('newpassword', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form__row">
            	<x-input-text label="Confirmez le nouveau mot de passe" id="password_confirmation" placeholder="Confirmez votre nouveau mot de passe" type="password"></x-input-text>
            	{!! $errors->first('password_confirmation', '<small class="help-block">:message</small>') !!}
            </div>

				<div class="form__row">
          	  <button type="submit" class="btn btn--primary">Modifier mon mot de passe!</button>
				</div>

		</form>

</div>
@endsection
