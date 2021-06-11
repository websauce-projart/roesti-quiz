@extends('template')

@section('title')
Choisis ta victime
@endsection

@section('content')
<div class="container">
	<form style="text-align:center;" method="POST" action="{{ route('creategame') }}" accept-charset="UTF-8">
			@csrf
			<div style="max-width:100rem;  display:inline-block; text-align:center;" id="vue_new_game">
						<new-game :datas=<?php echo json_encode($opponents); ?>></new-game>
			</div>
	</form>
</div>
@endsection
