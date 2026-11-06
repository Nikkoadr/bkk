<header class="app-topbar">
    <div class="topbar-left">
        <button type="button" class="icon-btn" id="sidebarToggle" aria-label="Buka menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="topbar-title">
            <span>Panel Admin</span>
            <strong>{{ now()->locale('id')->translatedFormat('l, d F Y') }}</strong>
        </div>
    </div>

    <div class="topbar-right">
        <a href="/" target="_blank" rel="noopener" class="topbar-link d-none d-md-inline-flex">
            <i class="fa-solid fa-globe"></i>
            <span>Website</span>
        </a>

        @include('layouts.partials.notifikasi_admin')

        <button type="button" class="icon-btn d-none d-sm-inline-flex" id="fullscreenBtn" aria-label="Layar penuh">
            <i class="fa-solid fa-expand"></i>
        </button>

        <div class="dropdown">
            <button type="button" class="user-chip" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/dist/img/avatar.png') }}" alt="Avatar {{ Auth::user()->name }}">
                <span class="user-meta">
                    <strong>{{ Auth::user()->name }}</strong>
                    <small>Administrator</small>
                </span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-end user-menu">
                <div class="menu-head">Akun Saya</div>
                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <i class="fa-regular fa-user"></i>
                    Profil &amp; Keamanan
                </a>
                <a href="/" target="_blank" rel="noopener" class="dropdown-item">
                    <i class="fa-solid fa-globe"></i>
                    Buka Website
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Keluar
                </a>
            </div>
        </div>
    </div>
</header>
