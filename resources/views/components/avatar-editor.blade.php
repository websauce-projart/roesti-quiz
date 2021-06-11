<div id="avatarEditor" class="avatar__editor">
    <div id="avatarContainer" class="avatar__editor__container">
        <div id="poses" class="avatar__editor__element avatar__element__poses"></div>
        <div id="eyes" class="avatar__editor__element avatar__element__eyes"></div>
        <div id="mouths" class="avatar__editor__element avatar__element__mouths"></div>

    </div>
    <div class="buttons__container">
        <span id="eyesRight">
            <img src="https://via.placeholder.com/80" alt="Bouton de changement d'yeux">
        </span>
        <span id="mouthsRight">
            <img src="https://via.placeholder.com/80" alt="Bouton de changement de bouche">
        </span>
        <span id="posesRight">
            <img src="https://via.placeholder.com/80" alt="Bouton de changement de pose">
        </span>
    </div>
</div>

<form action="{{$route}}" method="POST">
    @csrf
    <input type="hidden" id="eyesValue" name="eyes" value="1">
    <input type="hidden" id="mouthsValue" name="mouths" value="1">
    <input type="hidden" id="posesValue" name="poses" value="1">
    <x-input-submit label="{{$label}}"></x-input-submit>
</form>