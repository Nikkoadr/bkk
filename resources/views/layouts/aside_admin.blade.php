@php
    $navItems = [
        ['route' => '/home', 'active' => request()->is('home'), 'icon' => 'fa-solid fa-gauge-high', 'label' => 'Dashboard'],
        ['route' => '/data_loker', 'active' => request()->is('data_loker') || request()->is('edit_loker/*'), 'icon' => 'fa-solid fa-building', 'label' => 'Data Loker'],
        ['route' => '/status_pelamar', 'active' => request()->is('status_pelamar') || request()->is('edit_pelamar/*'), 'icon' => 'fa-solid fa-address-card', 'label' => 'Status Pelamar'],
        ['route' => '/tes/admin', 'active' => request()->is('tes/admin'), 'icon' => 'fa-solid fa-clipboard-list', 'label' => 'Daftar Tes'],
    ];
@endphp

<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <a href="/home" class="brand-link">
            <span class="brand-logo">
                <img src="{{ asset('assets/dist/img/logoKotak_kecil.png') }}" alt="Logo BKK">
            </span>
            <span class="brand-text">
                <strong>BKK Admin</strong>
                <small>SMK Muhammadiyah</small>
            </span>
        </a>
        <button type="button" class="sidebar-close" id="sidebarClose" aria-label="Tutup menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="sidebar-user">
        <img src="{{ asset('assets/dist/img/avatar.png') }}" alt="Avatar {{ Auth::user()->name }}">
        <div class="sidebar-user-info">
            <span>Masuk sebagai</span>
            <strong title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</strong>
        </div>
        <a href="{{ route('profile.edit') }}" title="Pengaturan profil">
            <i class="fa-solid fa-gear"></i>
        </a>
    </div>

    <div class="sidebar-scroll">
        <p class="nav-label">Menu Utama</p>
        <nav class="sidebar-nav">
            @foreach ($navItems as $item)
                <a href="{{ $item['route'] }}" class="nav-link {{ $item['active'] ? 'active' : '' }}" title="{{ $item['label'] }}">
                    <span class="nav-icon"><i class="{{ $item['icon'] }}"></i></span>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <p class="nav-label">Lainnya</p>
        <nav class="sidebar-nav">
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->is('profile') ? 'active' : '' }}" title="Profil Admin">
                <span class="nav-icon"><i class="fa-regular fa-user"></i></span>
                Profil Admin
            </a>
            <a href="/" target="_blank" rel="noopener" class="nav-link" title="Lihat Website">
                <span class="nav-icon"><i class="fa-solid fa-globe"></i></span>
                Lihat Website
            </a>
        </nav>
    </div>

    <div class="sidebar-foot">
        <a href="{{ route('logout') }}" class="sidebar-logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket"></i>
            Keluar dari akun
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</aside>
