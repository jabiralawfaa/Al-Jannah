<div class="form-group">
    @if(isset($label))
        <label class="form-label">{{ $label }}</label>
    @endif
    <select name="{{ $name }}" class="form-select">
        @if(isset($placeholder))
            <option value="">{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>
</div>
