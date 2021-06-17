<div class="presenter__container">
	<div class="container">
		<div class="presenter">
			@if(isset($mood))
				<img src="{{ asset('img/presenter/' . $mood . '.svg') }}" alt="Présentateur du RöestiQuiz" draggable="false">
			@else
				<img src="{{ asset('img/presenter/' . rand(1,4) . '.svg') }}" alt="Présentateur du RöestiQuiz" draggable="false">
			@endif
		</div>
	</div>
</div>
