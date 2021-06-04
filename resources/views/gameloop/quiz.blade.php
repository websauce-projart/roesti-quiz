@extends('gameloop/template_gameloop')

@section('title')
GAME
@endsection

@section('content')
<form action="" method="POST">
@csrf
    @foreach($questions as $question)
    <div>
        <strong>{{$question->label}} ?</strong>
         <div>
            Vrai?<input type="checkbox" name="{{$question->id}}">
         </div>
    </div>
    @endforeach
    <div>
        <x-input-submit label="Envoyer"></x-input-submit>
    </div>
</form>
@endsection