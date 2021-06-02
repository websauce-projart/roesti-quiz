<strong>Vos parties :</strong>
@foreach ($data as $gamedata)
    <div>
    {{$gamedata['user']->pseudo}} VS {{$gamedata['opponent']->pseudo}}
        <div>
        {{$gamedata['user']->getUserScore($gamedata['game']->id)}} à {{$gamedata['opponent']->getUserScore($gamedata['game']->id)}}
        </div>
    </div>
@endforeach