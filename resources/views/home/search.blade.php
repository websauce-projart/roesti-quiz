@extends('template')

@section('title')
Choisis ta victime
@endsection

@push('body-classes')
bg--white
@endpush

@section('content')
<main class="container speech-bubble">

	<nav class="topnav">
		<a href="{{ route('login') }}" class="icon-arrow-left"></a>
		<h1 class="pageTitle">Choisis ta victime</h1>
  </nav>

  <section class="category__container">
		<form class="form form--center form--large" style="text-align:center;" method="POST" action="{{ route('creategame') }}" accept-charset="UTF-8">
				@csrf
				<div id="vue_new_game">
					<new-game :datas=<?php echo json_encode($opponents); ?>></new-game>
				</div>
		</form>
	</section>

</main>

<x-presenter></x-presenter>

@endsection
