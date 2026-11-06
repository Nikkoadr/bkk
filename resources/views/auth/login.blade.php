<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk &middot; {{ config('app.name', 'BKK') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/dist/img/logoKotak_kecil.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --brand: #0b6bcb;
            --brand-light: #2b8cdf;
            --brand-dark: #0a4b8a;
            --brand-deep: #062b52;
            --ink: #12263f;
            --muted: #6b7c93;
            --line: #dfeaf6;
            --soft: #eef6ff;
        }

        * { box-sizing: border-box; }

        html, body { height: 100%; }

        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            color: var(--ink);
            background: var(--soft);
            -webkit-font-smoothing: antialiased;
        }

        a { color: var(--brand); text-decoration: none; }
        a:hover { color: var(--brand-dark); }

        .auth-shell {
            display: flex;
            min-height: 100vh;
        }

        /* ============ LEFT / BRAND PANEL ============ */
        .auth-visual {
            position: relative;
            flex: 1.05;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 3rem;
            padding: 3.25rem 3.5rem;
            color: #fff;
            overflow: hidden;
            background: linear-gradient(150deg, var(--brand-deep) 0%, var(--brand-dark) 45%, var(--brand) 100%);
        }

        .auth-visual::before,
        .auth-visual::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-visual::before {
            width: 520px;
            height: 520px;
            top: -220px;
            right: -140px;
            background: radial-gradient(circle at 30% 30%, rgba(94, 190, 255, .55), rgba(94, 190, 255, 0) 65%);
            animation: drift 14s ease-in-out infinite;
        }

        .auth-visual::after {
            width: 460px;
            height: 460px;
            bottom: -200px;
            left: -120px;
            background: radial-gradient(circle at 60% 40%, rgba(255, 255, 255, .22), rgba(255, 255, 255, 0) 68%);
            animation: drift 18s ease-in-out infinite reverse;
        }

        .visual-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, .045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, .045) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: radial-gradient(ellipse at 30% 20%, #000 0%, transparent 75%);
            -webkit-mask-image: radial-gradient(ellipse at 30% 20%, #000 0%, transparent 75%);
            pointer-events: none;
        }

        .visual-content { position: relative; z-index: 2; }

        .brand-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 4rem;
        }

        .brand-badge {
            width: 66px;
            height: 66px;
            flex: 0 0 66px;
            display: grid;
            place-items: center;
            border-radius: 20px;
            background: rgba(255, 255, 255, .96);
            box-shadow: 0 14px 34px rgba(2, 22, 44, .35);
            padding: 8px;
        }

        .brand-badge img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .brand-name {
            margin: 0;
            font-size: 1.02rem;
            font-weight: 700;
            letter-spacing: .2px;
            line-height: 1.35;
        }

        .brand-name span {
            display: block;
            font-size: .78rem;
            font-weight: 400;
            color: rgba(255, 255, 255, .68);
            letter-spacing: .6px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .visual-title {
            margin: 0 0 1rem;
            font-size: clamp(2rem, 3.1vw, 2.85rem);
            line-height: 1.16;
            font-weight: 800;
            letter-spacing: -.9px;
        }

        .visual-title em {
            font-style: normal;
            background: linear-gradient(100deg, #a5dcff, #ffffff);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .visual-sub {
            margin: 0;
            max-width: 30rem;
            font-size: 1rem;
            line-height: 1.7;
            color: rgba(255, 255, 255, .76);
            font-weight: 300;
        }

        .features {
            list-style: none;
            margin: 2.5rem 0 0;
            padding: 0;
            display: grid;
            gap: .95rem;
        }

        .features li {
            display: flex;
            align-items: center;
            gap: .9rem;
            font-size: .92rem;
            color: rgba(255, 255, 255, .88);
        }

        .features .ico {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            font-size: 1rem;
            color: #cde9ff;
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .14);
            backdrop-filter: blur(4px);
        }

        .visual-foot {
            position: relative;
            z-index: 2;
            font-size: .78rem;
            color: rgba(255, 255, 255, .5);
            letter-spacing: .3px;
        }

        /* ============ RIGHT / FORM PANEL ============ */
        .auth-form-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
            background:
                radial-gradient(900px 480px at 100% 0%, #e2f0ff 0%, rgba(255, 255, 255, 0) 60%),
                radial-gradient(700px 420px at 0% 100%, #eef7ff 0%, rgba(255, 255, 255, 0) 55%),
                #ffffff;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            animation: rise .65s cubic-bezier(.2, .7, .3, 1) both;
        }

        .mobile-brand {
            display: none;
            align-items: center;
            gap: .8rem;
            margin-bottom: 1.75rem;
        }

        .mobile-brand .brand-badge {
            width: 52px;
            height: 52px;
            flex-basis: 52px;
            border-radius: 15px;
            padding: 6px;
            background: #fff;
            border: 1px solid var(--line);
            box-shadow: 0 8px 20px rgba(11, 107, 203, .12);
        }

        .mobile-brand strong {
            display: block;
            font-size: .92rem;
            color: var(--brand-dark);
            line-height: 1.3;
        }

        .mobile-brand small {
            font-size: .72rem;
            color: var(--muted);
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .9px;
            text-transform: uppercase;
            color: var(--brand);
            background: #eaf4ff;
            border: 1px solid #d6e9ff;
            padding: .4rem .75rem;
            border-radius: 999px;
            margin-bottom: 1.1rem;
        }

        .auth-card h1 {
            margin: 0 0 .5rem;
            font-size: 1.85rem;
            font-weight: 800;
            letter-spacing: -.6px;
            color: var(--ink);
        }

        .auth-card .subtitle {
            margin: 0 0 1.9rem;
            font-size: .93rem;
            line-height: 1.6;
            color: var(--muted);
        }

        .alert-error {
            display: flex;
            gap: .65rem;
            align-items: flex-start;
            padding: .8rem .95rem;
            margin-bottom: 1.15rem;
            font-size: .85rem;
            color: #9f1c2e;
            background: #fff1f3;
            border: 1px solid #ffd3da;
            border-radius: 12px;
        }

        .alert-error i { margin-top: 1px; }

        .field { margin-bottom: 1.05rem; }

        .field label {
            display: block;
            margin-bottom: .45rem;
            font-size: .82rem;
            font-weight: 600;
            color: #33475f;
        }

        .input-wrap { position: relative; }

        .input-wrap > .lead-icon {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            font-size: 1.05rem;
            color: #93a7bd;
            pointer-events: none;
            transition: color .2s ease;
        }

        .input-wrap input {
            width: 100%;
            height: 52px;
            padding: 0 3rem 0 2.85rem;
            font-family: inherit;
            font-size: .94rem;
            color: var(--ink);
            background: #f8fbff;
            border: 1.5px solid var(--line);
            border-radius: 13px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .input-wrap input::placeholder { color: #a9b8c9; }

        .input-wrap input:hover { border-color: #c9dcf0; }

        .input-wrap input:focus {
            background: #fff;
            border-color: var(--brand-light);
            box-shadow: 0 0 0 4px rgba(43, 140, 223, .14);
        }

        .input-wrap:focus-within > .lead-icon { color: var(--brand); }

        .input-wrap input.is-invalid {
            border-color: #e35d6a;
            background: #fff8f8;
        }

        .input-wrap input.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(227, 93, 106, .14);
        }

        .toggle-pass {
            position: absolute;
            top: 50%;
            right: .55rem;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: #93a7bd;
            cursor: pointer;
            font-size: 1.02rem;
            transition: background .2s ease, color .2s ease;
        }

        .toggle-pass:hover { background: #eaf4ff; color: var(--brand); }
        .toggle-pass:focus-visible { outline: 2px solid var(--brand-light); outline-offset: 1px; }

        .error-text {
            display: block;
            margin-top: .4rem;
            font-size: .78rem;
            font-weight: 500;
            color: #d33d4d;
        }

        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin: .35rem 0 1.5rem;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-size: .84rem;
            color: #4a5d73;
            cursor: pointer;
            user-select: none;
        }

        .remember input {
            width: 17px;
            height: 17px;
            margin: 0;
            accent-color: var(--brand);
            cursor: pointer;
        }

        .forgot {
            font-size: .84rem;
            font-weight: 600;
            color: var(--brand);
            white-space: nowrap;
        }

        .forgot:hover { text-decoration: underline; }

        .btn-login {
            position: relative;
            width: 100%;
            height: 54px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .6rem;
            border: 0;
            border-radius: 13px;
            font-family: inherit;
            font-size: .98rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            overflow: hidden;
            background: linear-gradient(100deg, var(--brand-dark) 0%, var(--brand) 55%, var(--brand-light) 100%);
            background-size: 160% 100%;
            box-shadow: 0 14px 28px -10px rgba(11, 107, 203, .65);
            transition: background-position .35s ease, transform .18s ease, box-shadow .18s ease;
        }

        .btn-login:hover {
            background-position: 100% 0;
            transform: translateY(-2px);
            box-shadow: 0 18px 34px -10px rgba(11, 107, 203, .7);
        }

        .btn-login:active { transform: translateY(0); }

        .btn-login:focus-visible {
            outline: 3px solid rgba(43, 140, 223, .35);
            outline-offset: 3px;
        }

        .btn-login .arrow {
            transition: transform .22s ease;
            font-size: 1rem;
        }

        .btn-login:hover .arrow { transform: translateX(4px); }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .45rem;
            margin-top: 1.6rem;
            font-size: .76rem;
            color: #93a7bd;
        }

        .secure-note i { color: #4caf7d; }

        .copyright {
            margin-top: 2.25rem;
            text-align: center;
            font-size: .75rem;
            color: #a9b8c9;
            line-height: 1.6;
        }

        @keyframes drift {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(-18px, 26px, 0) scale(1.06); }
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(22px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 991.98px) {
            .auth-visual { display: none; }
            .mobile-brand { display: flex; }
            .auth-form-side { padding: 2.5rem 1.25rem; }
            .auth-card { max-width: 430px; }
        }

        @media (max-width: 420px) {
            .auth-card h1 { font-size: 1.6rem; }
            .auth-form-side { padding: 2rem 1.1rem; }
            .row-between { flex-wrap: wrap; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .001ms !important;
            }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <!-- Brand / info panel -->
        <aside class="auth-visual">
            <div class="visual-grid"></div>

            <div class="visual-content">
                <div class="brand-row">
                    <div class="brand-badge">
                        <img src="{{ asset('assets/dist/img/logoKotak_kecil.png') }}" alt="Logo BKK">
                    </div>
                    <p class="brand-name">
                        BKK SMK Muhammadiyah<br>Kandanghaur
                        <span>Bursa Kerja Khusus</span>
                    </p>
                </div>

                <h2 class="visual-title">Temukan <em>karier impianmu</em> bersama kami.</h2>
                <p class="visual-sub">
                    Satu pintu untuk informasi lowongan, pendaftaran kerja, dan pemantauan
                    status lamaran &mdash; cepat, transparan, dan tanpa ribet.
                </p>

                <ul class="features">
                    <li>
                        <span class="ico"><i class="bi bi-briefcase"></i></span>
                        Informasi lowongan kerja terverifikasi
                    </li>
                    <li>
                        <span class="ico"><i class="bi bi-file-earmark-text"></i></span>
                        Pendaftaran &amp; unggah berkas secara online
                    </li>
                    <li>
                        <span class="ico"><i class="bi bi-patch-check"></i></span>
                        Pantau status lamaran &amp; pembayaran
                    </li>
                </ul>
            </div>

            <div class="visual-foot">&copy; {{ date('Y') }} BKK SMK Muhammadiyah Kandanghaur</div>
        </aside>

        <!-- Login form -->
        <main class="auth-form-side">
            <div class="auth-card">
                <div class="mobile-brand">
                    <div class="brand-badge">
                        <img src="{{ asset('assets/dist/img/logoKotak_kecil.png') }}" alt="Logo BKK">
                    </div>
                    <div>
                        <strong>BKK SMK Muhammadiyah</strong>
                        <small>Kandanghaur</small>
                    </div>
                </div>

                <span class="eyebrow"><i class="bi bi-shield-lock"></i> Portal Admin</span>
                <h1>Selamat Datang Kembali</h1>
                <p class="subtitle">Masuk untuk melanjutkan ke {{ config('app.name', 'BKK') }}.</p>

                @if ($errors->any())
                    <div class="alert-error" role="alert">
                        <i class="bi bi-exclamation-circle"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <div class="field">
                        <label for="email">Alamat Email</label>
                        <div class="input-wrap">
                            <i class="bi bi-envelope lead-icon"></i>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="@error('email') is-invalid @enderror"
                                placeholder="nama@email.com"
                                required
                                autocomplete="email"
                                autofocus
                            >
                        </div>
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Kata Sandi</label>
                        <div class="input-wrap">
                            <i class="bi bi-lock lead-icon"></i>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="@error('password') is-invalid @enderror"
                                placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                                required
                                autocomplete="current-password"
                            >
                            <button type="button" class="toggle-pass" id="togglePassword" aria-label="Tampilkan kata sandi" aria-pressed="false">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row-between">
                        <label class="remember" for="remember">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            Ingat saya
                        </label>

                        @if (Route::has('password.request'))
                            <a class="forgot" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login">
                        Masuk ke Portal
                        <i class="bi bi-arrow-right arrow"></i>
                    </button>
                </form>

                <div class="secure-note">
                    <i class="bi bi-lock-fill"></i>
                    Koneksi aman &middot; data Anda terlindungi
                </div>

                <p class="copyright">
                    &copy; {{ date('Y') }} BKK SMK Muhammadiyah Kandanghaur.<br>
                    Seluruh hak cipta dilindungi.
                </p>
            </div>
        </main>
    </div>

    <script>
        (function () {
            const toggle = document.getElementById('togglePassword');
            const input = document.getElementById('password');
            if (!toggle || !input) return;

            toggle.addEventListener('click', function () {
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                toggle.setAttribute('aria-pressed', show ? 'true' : 'false');
                toggle.setAttribute('aria-label', show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
                toggle.innerHTML = show
                    ? '<i class="bi bi-eye-slash"></i>'
                    : '<i class="bi bi-eye"></i>';
                input.focus({ preventScroll: true });
            });
        })();
    </script>
</body>
</html>
