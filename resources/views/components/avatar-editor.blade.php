<div id="avatarEditor">
    <div id="avatarContainer">
        <div id="poses" class="avatar"></div>
        <div id="eyes" class="avatar"></div>
        <div id="mouths" class="avatar"></div>

    </div>
    <div id="left" class="arrowContainer">
        <span id="eyesLeft">←</span>
        <span id="mouthsLeft">←</span>
        <span id="posesLeft">←</span>
    </div>
    <div id="right" class="arrowContainer">
        <span id="eyesRight">→</span>
        <span id="mouthsRight">→</span>
        <span id="posesRight">→</span>
    </div>
</div>

<form action="{{$route}}" method="POST">
    @csrf
    <input type="hidden" id="eyesValue" name="eyes" value="1">
    <input type="hidden" id="mouthsValue" name="mouths" value="1">
    <input type="hidden" id="posesValue" name="poses" value="1">
    <x-input-submit label="{{$label}}"></x-input-submit>
</form>