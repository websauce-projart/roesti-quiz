@extends('template')

@section('title')
	 Backoffice: Questions
@endsection

@section('content')
<x-backoffice-nav></x-backoffice-nav>
<div class="container">

	<h1 class="center">Modification d'un utilisateur</h1>
		<form class="form form--center" method="POST" action="{{route('user.update', [$user->id])}}" accept-charset="UTF-8">
			@csrf
			@method('PUT')

			<div class="form__row">
				<div class="{!! $errors->has('pseudo') ? 'has-error' : '' !!}">
					<input type="text" name="pseudo" value="{{$user->pseudo}}" placeholder="Pseudo">
					{!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
				</div>
			</div>

			<div class="form__row">
				<div class="{!! $errors->has('email') ? 'has-error' : '' !!}">
					<input type="email" name="email" value="{{$user->email}}" placeholder="Email">
					{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
				</div>
			</div>

			<div class="form__row">
				<label>
					@if($user->admin)
						<input name="admin" value="1" type="checkbox" checked>
					@else
						<input name="admin" value="1" type="checkbox">
					@endif
					Administrateur
				</label>
			</div>

			<input class="btn btn--primary" type="submit" value="Envoyer">
		</form>
    </div>

</div>
@endsection
