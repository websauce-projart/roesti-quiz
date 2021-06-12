@extends('template')

@section('title')
Questions
@endsection

@section('content')

<x-backoffice-nav></x-backoffice-nav>

<div class="container container--large">
	<div class="center">
		<strong>Liste des questions</strong> | <a href="{{route('questions.create')}}">Créer une question</a>
	</div>

    @if(session()->has('ok'))
    <div>
        {!! session('ok') !!}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Réponse</th>
                <th>Catégories</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
            <tr>
                <td class="text__small">{{$question->id}}</td>
                <td class="text__small">{{$question->label}}</td>
                <td class="text__small">{{$question->getLitteralAnswer()}} {{$question->answer_label}}</td>
                <td class="text__small">{{$question->getCategoriesTitles()}}</td>
                <td class="text__small"><a class="icon-edit-pencil" href="{{route('questions.edit', [$question->id])}}"></a></td>
                <td>
                    <form method="POST" action="{{route('questions.destroy', [$question->id])}}">
                        @csrf
                        @method('DELETE')
                        <button class="icon-close" type="submit"
                            onclick="return confirm('Vraiment supprimer cette question ?')"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection