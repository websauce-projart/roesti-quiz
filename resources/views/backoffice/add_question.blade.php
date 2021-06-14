@extends('template')

@section('title')
Ajouter une question
@endsection

@push('body-classes')
pattern-stop
@endpush

@section('content')

<x-backoffice-nav></x-backoffice-nav>

<div class="container container--large">

    <div class="center">
        <a href="{{route('questions.index')}}">Liste des questions</a> | <strong>Créer une question</strong>
    </div>

    @if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible">
        {!! session('ok') !!}
    </div>
    @endif

    <form class="form margin-auto" action="{{ route('questions.store') }}" method="post" accept-charset="UTF-8">
        @csrf
        <div class="form__row">
            <strong>Entrez la question: </strong>
            <textarea id="label" name="label" rows="5" cols="33">{{ old('label') }}</textarea>
            {!! $errors->first('label', '<p><small class="help-block">:message</small></p>') !!}
        </div>

        <div class="form__row">
            <input type="checkbox" id="answer_boolean" name="answer_boolean" value="1" @if (old('answer_boolean') == 1) checked @endif>
            <label for="answer_boolean">Cochez si la question est fausse</label>
            <div class="form__row--displayCondition">
                <label for="answer_label">Entrez la réponse à la question ci-dessus: </label>
                <input name="answer_label" type="text" id="answer_label" value="{{ old('answer_label') }}">
				{!! $errors->first('answer_label', '<p><small class="help-block">:message</small></p>') !!}
            </div>
        </div>

        <div class="form__row">
            <strong>Sélectionner une ou plusieurs catégories:</strong>
            <div class="flex-column">

                @foreach($data as $category)
                <label for="{{$category->title}}" class="margin-small">
                    <input type="checkbox" id="{{$category->title}}" name="categories[]" value="{{$category->id}}"
					@if (is_array(old('categories')) && in_array($category->id, old('categories'))) checked @endif
					>
                    {{$category->title}}
                </label>
            	@endforeach

			</div>
            {!! $errors->first('categories', '<p><small class="help-block">:message</small></p>') !!}
        </div>

        <div class="form__row">
            <button class="btn btn--primary" type="submit" name="submit">Envoyer</button>
        </div>

    </form>
</div>
@endsection
