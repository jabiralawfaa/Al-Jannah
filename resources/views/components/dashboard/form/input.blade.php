<div class="form-group">
    @if(isset($label))
        <label class="form-label">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type ?? 'text' }}" 
        name="{{ $name }}" 
        class="form-input"
        value="{{ $value ?? old($name) }}"
        placeholder="{{ $placeholder ?? '' }}"
        {{ $required ?? '' }}
    >
</div>
