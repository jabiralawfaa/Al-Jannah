@props(['menus' => []])

<nav class="navbar">
    <!-- Logo -->
    <a href="/" class="navbar-logo">RKM Al-Jannah</a>

    <!-- Menu Tengah -->
    @if(count($menus) > 0)
        <ul class="nav-menu" id="navMenu">
            @foreach($menus as $menu)
                @if($menu['is_active'] ?? true)
                    <li>
                        <a href="{{ $menu['url'] ?? '#' }}" class="nav-link scroll-link">{{ $menu['title'] ?? 'Menu' }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    @else
        <!-- Default Static Menus (Fallback) -->
        <ul class="nav-menu" id="navMenu">
            <li>
                <a href="#visi-misi" class="nav-link scroll-link">Visi & Misi</a>
            </li>
            <li>
                <a href="#kanal-berita" class="nav-link scroll-link">Kanal Berita</a>
            </li>
            <li>
                <a href="#layanan-keuntungan" class="nav-link scroll-link">Layanan & Keuntungan</a>
            </li>
            <li>
                <a href="#hubungi-kami" class="nav-link scroll-link">Hubungi Kami</a>
            </li>
        </ul>
    @endif

    <!-- Tombol Kanan -->
    <div class="nav-buttons">
        <a href="#login" class="btn btn-login">Login</a>
        <a href="#daftar" class="btn btn-daftar">Daftar Anggota</a>
    </div>

    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>

<script>
    // Smooth Scroll for Navbar Links
    document.addEventListener('DOMContentLoaded', function() {
        const scrollLinks = document.querySelectorAll('.scroll-link');
        const navbar = document.querySelector('.navbar');
        
        scrollLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Only apply for anchor links
                if (href.startsWith('#') && href.length > 1) {
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);
                    
                    // If section exists on current page, smooth scroll
                    if (targetElement) {
                        e.preventDefault();
                        
                        // Close mobile menu if open
                        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
                        const navMenu = document.getElementById('navMenu');
                        if (mobileMenuToggle && navMenu) {
                            mobileMenuToggle.classList.remove('active');
                            navMenu.classList.remove('active');
                        }
                        
                        // Smooth scroll with offset for fixed navbar
                        const navbarHeight = navbar?.offsetHeight || 80;
                        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                        
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                    // If section doesn't exist (e.g., on post detail page), redirect to homepage
                    else if (window.location.pathname !== '/') {
                        e.preventDefault();
                        
                        // Close mobile menu if open
                        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
                        const navMenu = document.getElementById('navMenu');
                        if (mobileMenuToggle && navMenu) {
                            mobileMenuToggle.classList.remove('active');
                            navMenu.classList.remove('active');
                        }
                        
                        // Redirect to homepage with hash
                        window.location.href = '/' + href;
                    }
                }
            });
        });
    });
</script>
