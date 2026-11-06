@extends('layouts.main_admin')

@section('title', 'Profil Admin')

@section('content')
<div class="page-head">
    <div>
        <nav class="crumbs">
            <a href="/home">Admin</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Profil</span>
        </nav>
        <h1>Profil Admin</h1>
        <p>Perbarui identitas akun dan kata sandi untuk menjaga keamanan panel admin.</p>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Informasi Akun</h2>
            <p>Nama dan email digunakan untuk login ke panel admin.</p>
        </div>
        <img src="{{ asset('assets/dist/img/avatar.png') }}" alt="Avatar" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #e3eefb;">
    </div>

    <div class="panel-body">
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            @method('put')

            <div class="form-section"><i class="fa-regular fa-id-badge"></i> Identitas</div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required autocomplete="name">
                    @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required autocomplete="email">
                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-section"><i class="fa-solid fa-lock"></i> Ubah Kata Sandi</div>

            <p class="text-muted" style="font-size:.8rem;margin-top:-.2rem;">
                Kosongkan bagian ini jika tidak ingin mengganti kata sandi.
            </p>

            <div class="form-grid">
                <div class="form-group">
                    <label for="current_password">Kata Sandi Saat Ini</label>
                    <input type="password" id="current_password" name="current_password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           autocomplete="current-password" placeholder="Masukkan kata sandi saat ini">
                    @error('current_password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           autocomplete="new-password" placeholder="Minimal 8 karakter">
                    @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-control" autocomplete="new-password" placeholder="Ulangi kata sandi baru">
                </div>
            </div>

            <div class="form-actions">
                <span class="text-muted" style="font-size:.78rem;">
                    <i class="fa-solid fa-shield-halved"></i>
                    Perubahan langsung berlaku setelah disimpan.
                </span>
                <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
