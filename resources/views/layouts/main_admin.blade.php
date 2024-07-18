    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Admin | BKK</title>
        <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free-6.5.2-web/css/all.min.css') }}" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/dist/img/logoKotak.png') }}">
        @yield('link')
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('layouts.navbar_admin')
            @include('layouts.aside_admin')
            @yield('content')
            @include('layouts.footer_admin')
        </div>
        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        @yield('script')
    </body>
    </html>
