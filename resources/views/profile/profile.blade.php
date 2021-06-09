@extends('/home/template_home')

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
    <a href="{{route('updatePasswordForm')}}">Modifier mon mot de passe</a></li>
    </br>
    <form class="form-horizontal" method="post" action="{{route('deleteAccount')}}"
        onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">
        @csrf
        <input type="submit" value="Supprimer mon compte">
    </form>
</div>
</br>
<div>
    Mes trophées

    Liste des trophées
</div>

@endsection