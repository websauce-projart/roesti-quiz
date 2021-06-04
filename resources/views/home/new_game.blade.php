@extends('home/template_home')

@section('title')
    RöstiQuiz - Choisi ta victime
@endsection

@section('contenu')
    <form method="POST" action="{{ route('category') }}" accept-charset="UTF-8">
        @csrf
        <input class="" type="text">
        @foreach ($data as $user)
            <div>
                <input type="radio" id="{{ $user->id }}" name="user" value="{{ $user->id }}">
                <label for="{{ $user->id }}">{{ $user->pseudo }}</label>
            </div>
        @endforeach
        <input class="" type="submit" value="Suivant">
    </form>
@endsection
