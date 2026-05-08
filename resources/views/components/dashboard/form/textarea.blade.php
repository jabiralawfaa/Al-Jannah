<div class="form-group">
    @if(isset($label))
        <label class="form-label">{{ $label }}</label>
    @endif
    <textarea 
        name="{{ $name }}" 
        class="form-textarea"
        placeholder="{{ $placeholder ?? '' }}"
    >{{ $value ?? old($name) }}</textarea>
</div>
