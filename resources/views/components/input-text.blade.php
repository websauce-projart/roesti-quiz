    <label for="{{ $id }}">{{ '' }}</label>
    <div class="form__field">
        <input type="{{ $type }}" id="{{ $id }}" class="textbox" name="{{ $id }}" value="{{ $value }}"
            placeholder="{{ $label }}">
        @isset($icon)
            <i class="icon-{{ $icon }}"></i>
        @endisset
    </div>
