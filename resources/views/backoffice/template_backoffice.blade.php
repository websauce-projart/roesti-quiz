<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Backoffice</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
</head>
<div class="topnav">
  
  <a class="active" href="/backoffice">Home</a>
  <a href="backoffice/user">Liste des utilisateurs</a>
  <a href="backoffice/question">Ajouter des questions</a>
  @if(Auth::check())
              <a href="{{url('logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                @else 
                <a href="{{url('login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                @endif
</div>
<body>
@yield('contenu')
</body>

</html>