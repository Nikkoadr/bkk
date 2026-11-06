<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin') &middot; BKK SMK Muhammadiyah Kandanghaur</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome (local) --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free-6.5.2-web/css/all.min.css') }}" />

    {{-- Bootstrap 5 via Vite --}}
    @vite('resources/sass/app.scss')

    {{-- Custom BKK admin theme --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bkk-theme.css') }}" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak_kecil.png') }}">
    @yield('link')
</head>
<body class="bkk-admin">
    <div class="app-shell">
        @include('layouts.aside_admin')

        <div class="app-main">
            @include('layouts.navbar_admin')

            <main class="app-content">
                @yield('content')
            </main>

            @include('layouts.footer_admin')
        </div>
    </div>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    {{-- jQuery dibutuhkan oleh DataTables & plugin lama --}}
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    @vite('resources/js/app.js')
    {{-- SweetAlert2 --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        // Fallback jika SweetAlert2 lokal gagal dimuat
        if (typeof Swal === 'undefined') {
            var s = document.createElement('script');
            s.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            s.onload = function () { window.dispatchEvent(new Event('swal:ready')); };
            document.head.appendChild(s);
        }
    </script>
    <script src="{{ asset('assets/js/bkk-admin.js') }}"></script>
    @yield('script')
</body>
</html>
