@extends('template')

@section('title')
Accueil
@endsection

@section('content')
<div class="speech-bubble">
    <div id="vue_home">
        <home data_url='/api/home'></home>
    </div>
    <script src="js/app.js"></script>
</div>
<form class="bottombar" method="POST" action="" accept-charset="UTF-8">
    @csrf
    <x-input-submit label="Nouvelle partie"></x-input-submit>
</form>
@endsection
