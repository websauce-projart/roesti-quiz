@extends('home/template_home')

@section('title')
RöstiQuiz - Choisi ta victime
@endsection

@section('contenu')
<form method="POST" action="{{url('home')}}" accept-charset="UTF-8">
   @csrf
   <input class="" type="text">
</form>

@endsection