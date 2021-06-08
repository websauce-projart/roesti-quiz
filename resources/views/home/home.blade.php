@extends('home/template_home')

@section('title')
RöstiQuiz - Accueil
@endsection

@section('contenu')
<div class="speech-bubble">
    <div id="home">
        <home :datas='@json($data)'></home>
    </div>
    <script src="js/app.js"></script>
</div>
<form method="POST" action="" accept-charset="UTF-8">
    @csrf
    <x-input-submit label="Nouvelle partie"></x-input-submit>
</form>
@endsection