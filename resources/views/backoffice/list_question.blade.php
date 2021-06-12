@extends('template')

@section('title')
Questions
@endsection

@section('content')

<x-backoffice-nav></x-backoffice-nav>

<div class="container container--large">
	<div class="center">
		<strong>Liste des questions</strong> | <a href="{{route('addQuestion')}}">Créer une question</a>
	</div>

    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Réponse</th>
                <th>Catégories</th>
                <th>Auteur</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
            <tr>
                <td class="text__small">{{$question->label}}</td>
                <td class="text__small">{{$question->getLitteralAnswer()}} {{$question->answer_label}}</td>
                <td class="text__small">{{$question->getCategoriesTitles()}}</td>
                <td class="text__small">{{$question->author_id}}</td>
                <td class="text__small"><a class="icon-edit-pencil" href=""></a></td>
                <td>
                    <form method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button class="icon-close" type="submit"
                            onclick="return confirm('Vraiment supprimer cet utilisateur ?')"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection