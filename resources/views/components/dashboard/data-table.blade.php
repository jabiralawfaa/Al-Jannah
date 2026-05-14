@props([
    'title' => '',
    'headers' => [],
    'paginator' => null,
    'searchable' => true,
    'searchName' => 'search',
    'searchPlaceholder' => 'Cari...',
    'searchValue' => null,
    'actionUrl' => null,
    'actionLabel' => null,
    'actionIcon' => 'add',
    'actionId' => null,
])

<div class="card" style="padding: 0; overflow: hidden;">
    <div style="background-color: var(--primary-900); color: white; padding: 14px 24px; font-weight: 600; font-size: 16px; display: flex; justify-content: space-between; align-items: center;">
        <span>{{ $title }}</span>
        @if($actionUrl)
            <a href="{{ $actionUrl }}" id="{{ $actionId }}" class="btn btn-sm" style="background-color: white; color: black; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                <span class="material-icons" style="font-size: 16px;">{{ $actionIcon }}</span>
                {{ $actionLabel }}
            </a>
        @endif
    </div>

    @if($searchable)
        <div style="padding: 5px; display: flex; gap: 8px;">
            <div style="position: relative; flex: 1;">
                <span class="material-icons" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--secondary-600); font-size: 20px; pointer-events: none;">search</span>
                <input type="text" name="{{ $searchName }}" placeholder="{{ $searchPlaceholder }}" class="form-input data-table-search" style="padding-left: 40px; width: 100%;" value="{{ $searchValue ?? request($searchName) }}" data-search-name="{{ $searchName }}">
            </div>
            @if(request($searchName))
                <a href="{{ url()->current() }}" class="btn btn-outline-primary btn-sm" style="display: inline-flex; align-items: center; gap: 4px; white-space: nowrap; flex-shrink: 0;">
                    <span class="material-icons" style="font-size: 16px;">close</span> Reset
                </a>
            @endif
        </div>
    @endif

    <x-dashboard.table :headers="$headers">
        {{ $slot }}
    </x-dashboard.table>

    @if($paginator && $paginator->hasPages())
        <div style="padding: 16px 24px;">
            {{ $paginator->links() }}
        </div>
    @endif
</div>

@once
    <script>
        document.addEventListener('input', function(e) {
            if (e.target.matches('.data-table-search')) {
                clearTimeout(e.target._searchTimeout);
                e.target._searchTimeout = setTimeout(function() {
                    var url = new URL(window.location.href);
                    url.searchParams.set(e.target.dataset.searchName || 'search', e.target.value);
                    window.location.href = url.toString();
                }, 400);
            }
        });
    </script>
@endonce
