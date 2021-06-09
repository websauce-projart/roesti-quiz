@extends('template')

@section('title')
    Choisis ta victime
@endsection

@section('content')
<form method="POST" action="{{ route('creategame') }}" accept-charset="UTF-8">
        @csrf
<div class="speech-bubble">
        <div id="vue_new_game">
                <new-game :datas=<?php echo json_encode($opponents); ?>></new-game>
        </div>
</div>
        <input class="" type="submit" value="Suivant">
    </form>
    <script src="js/app.js"></script>
@endsection
