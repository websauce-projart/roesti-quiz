@extends('template')

@section('title')
Choix de ta catégorie
@endsection

@push('body-classes')
bg--white
@endpush

@section('content')
<main class="container speech-bubble">

	<nav class="topnav">
		<a class="icon-arrow-left" href="{{ route("home") }}" aria-label="Retour"></a>
		<h1 class="pageTitle">Choisis ta catégorie</h1>
	</nav>


    <form action="{{ route('category', $data) }}" method="post">
        @csrf

		  <div class="category__container">
			@foreach ($categories as $category)
			<div class="category">
					<input required name="categories" id="{{ $category }}" type="radio" value="{{ $category }}">
					<label class="btn btn--secondary" for="{{ $category }}">{{ $category }}</label>
				</div>
			@endforeach
		</div>

		<div class="bottombar">
      	<button class="btn btn--primary" type="submit">Suivant</button>
		</div>
    </form>
	</main>
@endsection
