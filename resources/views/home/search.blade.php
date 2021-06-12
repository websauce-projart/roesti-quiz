@extends('template')

@section('title')
Choisis ta victime
@endsection

@push('body-classes')
bg--white
@endpush

@section('content')
<main class="container speech-bubble speech-bubble--minHeight">

	<nav class="topnav">
		<a href="{{ route('login') }}" class="icon-arrow-left"></a>
		<h1 class="pageTitle">Choisis ta victime</h1>
  </nav>

  <section class="category__container">
		<form class="form form--center" style="text-align:center;" method="POST" action="{{ route('creategame') }}" accept-charset="UTF-8">
				@csrf
				<div style="max-width:100rem;  display:inline-block; text-align:center;" id="vue_new_game">
					<new-game :datas=<?php echo json_encode($opponents); ?>></new-game>
				</div>
		</form>
	</section>

</main>
@endsection
