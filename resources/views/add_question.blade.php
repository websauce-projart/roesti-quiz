<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
</head>

<body>
    <div>
    @if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible">
        {!! session('ok') !!}
    </div>
    @endif
        <form action="{{ route('question.store') }}" method="post" accept-charset="UTF-8">
            @csrf
            <label for="label">Entrez la question: </label>
            <input name="label" type="text" id="label">
            {!! $errors->first('label', '<small class="help-block">:message</small>') !!}
            </br>
            <label for="answer_boolean">Cochez si la question est fausse</label>
            <input type="checkbox" id="answer_boolean" name="answer_boolean" value=1>
            </br>
            <label for="answer_label">Entrez la réponse si vous avez cochez en dessus: </label>
            <input name="answer_label" type="text" id="answer_label">
            </br>
            <p>Sélectionner une ou plusieurs catégories</p>
            @foreach($data as $category)
            <input type="checkbox" id="{{$category->title}}" name="categories[]" value="{{$category->id}}">
            <label for="{{$category->title}}">{{$category->title}}</label>
            {!! $errors->first('categories', '<small class="help-block">:message</small>') !!}
            </br>
            @endforeach
            <input type="submit" name="submit" value="Envoyer"/>
        </form>
    </div>
</body>

</html>