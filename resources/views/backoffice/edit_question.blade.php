@extends('template')

@section('title')
Modifier une question
@endsection

@push('body-classes')
pattern-stop
@endpush

@section('content')
<x-backoffice-nav></x-backoffice-nav>
<div class="container container--large">

    <div class="center">
        <a href="{{route('questions.index')}}">Retour à la liste des questions</a>
    </div>

    <form class="form margin-auto" action="{{ route('questions.update', [$question->id]) }}" method="post"
        accept-charset="UTF-8">
        @csrf
        @method('PUT')

        <div class="form__row">
            <strong>Entrez la question: </strong>
            <textarea id="label" name="label" rows="5" cols="33">@if(!is_null(old('label'))){{old('label')}}@else{{$question->label}}@endif</textarea>
            {!! $errors->first('label', '<p><small class="help-block">:message</small></p>') !!}
        </div>

        <div class="form__row">
            <input type="checkbox" id="answer_boolean" name="answer_boolean" value="1"
            @if (!is_null(old('answer_boolean')) && old('answer_boolean') == 1) checked @elseif(is_null(old('answer_boolean')) && $question->answer_boolean == 0) checked @endif >
            <label for="answer_boolean">Cochez si la question est fausse</label>
            <div class="form__row--displayCondition">
                <label for="answer_label">Entrez la réponse à la question ci-dessus: </label>
                <input name="answer_label" type="text" id="answer_label" value="@if(!is_null(old('answer_label'))){{old('answer_label')}}@else{{$question->answer_label}}@endif">
				{!! $errors->first('answer_label', '<p><small class="help-block">:message</small></p>') !!}
            </div>
        </div>

        <div class="form__row">
            <strong>Sélectionner une ou plusieurs catégories:</strong>
            <div class="flex-column">

                @foreach($categories as $category)
                <label for="{{$category->title}}" class="margin-small">
                    <input type="checkbox" id="{{$category->title}}" name="categories[]" value="{{$category->id}}"
					@if (is_array(old('categories')) && in_array($category->id, old('categories'))) checked
                    @elseif ($question->categories()->get()->contains($category)) checked
                    @endif
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

</div>
@endsection
