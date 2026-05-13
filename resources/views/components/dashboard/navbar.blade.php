<header class="navbar">
    <div class="navbar-brand">
        RKM AL-JANNAH
    </div>
    <div class="navbar-right">
        <div class="navbar-user">
            <span>{{ auth()->user()->nama ?? 'User' }}</span>
            <span>|</span>
            <a href="{{ route('logout') }}" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</header>
