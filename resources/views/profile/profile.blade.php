@extends('home/template_home')

@section('title')
RöstiQuiz - Profil
@endsection

@section('contenu')
<div>
INSERT ROSTI HERE
</div>
</br>
<div>
{{$data['user']->pseudo}}
</br>
{{$data['score']['titleScore']}} - {{$data['score']['points']}}
</div>
</br>
<div>
    <form method="POST" action="" accept-charset="UTF-8">
        @csrf
        <input class="" type="submit" value="Changer de mot de passe">
    </form>
</br>
<form class="form-horizontal" method="post" action=""
onsubmit="return confirm('You have created a new batch. Click OK to confirm or you can ignore by clicking Cancel.');">
<input type="submit" value="Supprimer mon compte">
</form>
</div>
</br>
<div>
Mes trophées

Liste des trophées
</div>

@endsection