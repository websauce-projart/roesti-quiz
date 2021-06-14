<div id="avatarEditor" class="avatar__editor">
	<div id="avatarContainer" class="avatar__editor__container">
		<div id="poses" class="avatar__editor__element avatar__element__poses"></div>
		<div id="eyes" class="avatar__editor__element avatar__element__eyes"></div>
		<div id="mouths" class="avatar__editor__element avatar__element__mouths"></div>

	</div>
	<div class="buttons__container">
		<button id="eyesRight">
				<img src="{{ asset("img/avatar/buttons/eye.svg") }}" alt="Bouton de changement d'yeux">
		</button>
		<button id="mouthsRight">
				<img src="{{ asset("img/avatar/buttons/mouth.svg") }}" alt="Bouton de changement de bouche">
		</button>
		<button id="posesRight">
				<img src="{{ asset("img/avatar/buttons/arm.svg") }}" alt="Bouton de changement de pose">
		</button>
	</div>
</div>


<form action="{{$route}}" method="POST">

	@csrf
	<input type="hidden" id="eyesValue" name="eyes" value="1">
	<input type="hidden" id="mouthsValue" name="mouths" value="1">
	<input type="hidden" id="posesValue" name="poses" value="1">

	<div class="bottombar">
			<x-input-submit label="{{$label}}"></x-input-submit>
	</div>

</form>
