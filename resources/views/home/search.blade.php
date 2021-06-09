@extends('home/template_home')

@section('title')
    RöstiQuiz - Choisis ta victime
@endsection

@section('contenu')
<form method="POST" action="{{ route('creategame') }}" accept-charset="UTF-8">
        @csrf
<div class="speech-bubble">
        <div id="vue_new_game">
        <new-game></new-game>
        </div>
</div>
        <input class="" type="submit" value="Suivant">
    </form>
    <script src="js/app.js"></script>
@endsection
