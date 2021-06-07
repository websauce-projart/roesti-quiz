<!-- Import CSS -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Luckiest Guy">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<!-- HTML code -->
<div class="test">
    <span class="test--pseudo">{{$pseudo}}</span>
    <span class="test--info">À toi de jouer</span>
    <form method="POST" action="{{ route('getresults') }}" accept-charset="UTF-8">
        @csrf
        <input type="hidden" name="game_id" value="{{$value}}">
        <input class = "test--submit" type="submit" value="">
    </form>
</div>