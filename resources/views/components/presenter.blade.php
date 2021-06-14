<div class="presenter__container">
	<div class="container">
		<div class="presenter">
			@if(isset($mood))
				<img src="{{ asset('img/presenter/' . $mood . '.svg') }}" alt="">
			@else
				<img src="{{ asset('img/presenter/' . rand(1,4) . '.svg') }}" alt="">
			@endif
		</div>
	</div>
</div>
