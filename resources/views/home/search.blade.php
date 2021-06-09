@extends('template')

@section('title')
    Choisis ta victime
@endsection

@section('content')
    <form method="POST" action="{{ route('creategame') }}" accept-charset="UTF-8">
        @csrf
        <input class="" type="text">
        @foreach ($opponents as $opponent)
            <div>
                <input type="radio" id="{{ $opponent->id }}" name="user" value="{{ $opponent->id }}">
                <label for="{{ $opponent->id }}">{{ $opponent->pseudo }}</label>
            </div>
        @endforeach
        <input class="" type="submit" value="Suivant">
    </form>
@endsection
