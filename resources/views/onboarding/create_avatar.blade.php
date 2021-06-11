@extends('template')

@section('title')
Création d'avatar
@endsection

@section('content')
Quel rösti es-tu {{$pseudo}} ?



<form method="post" action="">
    <input type="submit" value="Suivant"/>
</form>
@endsection