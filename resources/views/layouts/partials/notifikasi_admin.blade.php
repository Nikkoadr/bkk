@php
    $pendingPayments = \App\Models\Pendaftaran::where('status_bayar', 'menunggu')->count();
@endphp

<div class="dropdown">
    <button type="button" class="icon-btn" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifikasi">
        <i class="fa-regular fa-bell"></i>
        @if ($pendingPayments > 0)
            <span class="dot-badge">{{ $pendingPayments > 99 ? '99+' : $pendingPayments }}</span>
        @endif
    </button>

    <div class="dropdown-menu dropdown-menu-end topbar-menu">
        <div class="menu-head">Notifikasi</div>

        @if ($pendingPayments > 0)
            <a href="{{ route('status_pelamar') }}" class="menu-note">
                <span class="note-icon"><i class="fa-solid fa-clock"></i></span>
                <span>
                    <strong>{{ $pendingPayments }} pembayaran menunggu verifikasi</strong>
                    <span>Klik untuk membuka daftar pelamar</span>
                </span>
            </a>
        @else
            <div class="menu-note">
                <span class="note-icon" style="background:#e6f8f0;color:#0f9d68;">
                    <i class="fa-solid fa-circle-check"></i>
                </span>
                <span>
                    <strong>Tidak ada notifikasi baru</strong>
                    <span>Semua pembayaran sudah diverifikasi</span>
                </span>
            </div>
        @endif

        <div class="dropdown-divider"></div>
        <a href="{{ route('status_pelamar') }}" class="dropdown-item">
            <i class="fa-solid fa-arrow-right"></i>
            Lihat semua status pelamar
        </a>
    </div>
</div>
