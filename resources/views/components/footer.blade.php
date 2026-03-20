@props(['footerMenus' => [], 'socialLinks' => []])

<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <!-- Brand Section -->
            <div class="footer-brand">
                <h3 class="footer-brand-title">RKM Al-Jannah</h3>
                <p class="footer-brand-text">Rukun Kematian Al-Jannah</p>
            </div>

            <!-- Footer Menu (Optional) -->
            @if(count($footerMenus) > 0)
                <div class="footer-menu">
                    <ul class="footer-menu-list">
                        @foreach($footerMenus as $menu)
                            @if($menu['is_active'] ?? true)
                                <li>
                                    <a href="{{ $menu['url'] ?? '#' }}" class="footer-menu-link">{{ $menu['title'] ?? 'Menu' }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Divider -->
            <div class="footer-divider"></div>

            <!-- Developer Credit -->
            <div class="footer-developer">
                <p class="footer-developer-text">
                    Developed by <span class="footer-developer-name">GeoDev Creator Poliwangi</span>
                </p>
            </div>
        </div>
    </div>
</footer>
