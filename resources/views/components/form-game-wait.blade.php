<!-- HTML code -->
<div class="home--game home--game--wait">
    <span class="home--game--pseudo">{{$pseudo}}</span>
    <span class="home--game--info">N'a pas encore relevé ton défi...</span>
    <form method="POST" action="{{ route('getresults') }}" accept-charset="UTF-8">
        @csrf
        <input type="hidden" name="game_id" value="{{$value}}">
        <input class = "home--game--submit" type="submit" value="">
    </form>
</div>