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

    @foreach ($categories as $category)
        {{ strtolower($category) }}
    @endforeach


    <form action="" method="post">
        <fieldset>

            {{-- @foreach ($categories as $category)
                <input name="cat_{{ $category->id }}" id="cat_{{ $category->id }}" type="checkbox">
                <label for="cat_{{ $category->id }}">{{ $category->title }}</label>
            @endforeach --}}

        </fieldset>

        <input type="submit" value="C'est parti mon roesti">
    </form>
@endsection
