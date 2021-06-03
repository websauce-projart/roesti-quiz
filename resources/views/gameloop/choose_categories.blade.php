@extends('gameloop/template_gameloop')

@section('title')
    Choix de ta catégorie
@endsection

@section('content')
    <h1>
        <a href="{{ url()->previous() }}">
            <- </a>
                Choix de ta catégorie
    </h1>

    <form action="" method="post">

        @foreach ($categories as $category)
            <input name="categories" id="{{ $category }}" type="radio">
            <label for="{{ $category }}">{{ $category }}</label>
        @endforeach

        <input type="submit" value="C'est parti mon roesti">
    </form>
@endsection
