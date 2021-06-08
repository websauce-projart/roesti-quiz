<!-- HTML code -->
<div class="home--game">
    <span class="home--game--pseudo">{{$pseudo}}</span>
    <span class="home--game--info">À toi de jouer</span>
    <form method="POST" action="{{ route('getresults') }}" accept-charset="UTF-8">
        @csrf
        <input type="hidden" name="game_id" value="{{$value}}">
        <div class="home--game--play">
            <span class="home--game--play--text">-></span>
        </div>
        <input class = "home--game--submit" type="submit" value="">
    </form>
</div>