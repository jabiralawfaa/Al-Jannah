<aside class="sidebar">
    <div class="sidebar-logo">
        RKM AL-JANNAH
    </div>
    <nav class="sidebar-menu">
        @foreach($menuItems as $item)
            <a 
                href="{{ $item['url'] }}" 
                class="sidebar-menu-item {{ request()->is($item['active']) ? 'active' : '' }}"
            >
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</aside>
