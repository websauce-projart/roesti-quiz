@extends('template')

@section('title')
Ajouter une question
@endsection

@section('content')

<x-backoffice-nav></x-backoffice-nav>

<div class="container container--large">

	<div class="center">
		<a href="{{route('indexQuestion')}}">Liste des questions</a> | <strong>Créer une question</strong>
	</div>

	@if(session()->has('ok'))
		<div class="alert alert-success alert-dismissible">
				{!! session('ok') !!}
		</div>
	@endif

	<form class="form form--center" action="{{ route('addQuestion') }}" method="post" accept-charset="UTF-8">
		@csrf
		<div class="form__row">
			<label for="label">Entrez la question: </label>
			<input name="label" type="text" id="label">
			{!! $errors->first('label', '<small class="help-block">:message</small>') !!}
		</div>

		<div class="form__row">
			<input type="checkbox" id="answer_boolean" name="answer_boolean" value=1>
			<label for="answer_boolean">Cochez si la question est fausse</label>
			<div class="form__row--displayCondition">
				<label for="answer_label">Entrez la réponse à la question ci-dessus: </label>
				<input name="answer_label" type="text" id="answer_label">
			</div>
		</div>

		<div class="form__row">
			<label>Sélectionner une ou plusieurs catégories:</label>
			@foreach($data as $category)
				<div>
					<label for="{{$category->title}}">
						<input type="checkbox" id="{{$category->title}}" name="categories[]" value="{{$category->id}}">
						{{$category->title}}
					</label>
				</div>
			@endforeach
			{!! $errors->first('categories', '<small class="help-block">:message</small>') !!}

		</div>

		<div class="form__row">
			<button class="btn btn--primary" type="submit" name="submit">Envoyer</button>
		</div>

	</form>

</div>
@endsection
