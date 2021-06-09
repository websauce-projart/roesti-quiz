@extends('template')

@section('title')
    Choix de ta catégorie
@endsection

@section('content')
    <h1>
        <a href="{{ url()->previous() }}">
            <- </a>
                Choix de ta catégorie
    </h1>

    <form action="{{ route('category', $data) }}" method="post">
        @csrf

        @foreach ($categories as $category)
            <input required name="categories" id="{{ $category }}" type="radio" value="{{ $category }}">
            <label for="{{ $category }}">{{ $category }}</label>
        @endforeach

        <input type="submit" value="C'est parti mon roesti">
    </form>
@endsection
