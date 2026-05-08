<a 
    href="{{ $url ?? '#' }}" 
    class="btn btn-{{ $variant ?? 'primary' }} {{ $size ?? '' }}"
    @if(isset($onclick)) onclick="{{ $onclick }}" @endif
>
    {{ $label }}
</a>
