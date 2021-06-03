<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter une question</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
</head>

<body>
<div>
    <div>
        <div>Modification d'un utilisateur</div>
        <div>
            <div>
                <form method="POST" action="{{route('user.update', [$user->id])}}" accept-charset="UTF-8">
                    @csrf
                    @method('PUT')
                    <div class="{!! $errors->has('pseudo') ? 'has-error' : '' !!}">
                        <input type="text" name="pseudo" value="{{$user->pseudo}}" placeholder="Pseudo">  
                        {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="{!! $errors->has('email') ? 'has-error' : '' !!}">
                        <input type="email" name="email" value="{{$user->email}}" placeholder="Email">  
                        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div>
                        <div>
                            <label>
                                @if($user->admin)
                                   <input name="admin" value="1" type="checkbox" checked>
                                @else
                                   <input name="admin" value="1" type="checkbox">
                                @endif
                                Administrateur
                            </label>
                        </div>
                    </div>
                    <input class="btn btn-primary pull-right" type="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>Retour
    </a>
</div>
</body>

</html>