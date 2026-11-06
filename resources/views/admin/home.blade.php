@extends('layouts.main_admin')

@section('title', 'Dashboard')

@section('content')
<div class="page-head">
    <div>
        <nav class="crumbs">
            <a href="/home">Admin</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Dashboard</span>
        </nav>
        <h1>Dashboard</h1>
        <p>Ringkasan lowongan, pendaftar, dan pembayaran BKK dalam satu tampilan.</p>
    </div>
    <div class="page-actions">
        <a href="/laporan/download" class="btn btn-secondary">
            <i class="fa-solid fa-download"></i>
            Unduh Laporan
        </a>
        <a href="{{ route('data_loker') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Kelola Loker
        </a>
    </div>
</div>

<div class="stat-grid">
    <a href="{{ route('data_loker') }}" class="stat-card stat-blue">
        <div class="stat-top">
            <span class="stat-icon"><i class="fa-solid fa-building"></i></span>
            <span class="stat-tag"><i class="fa-solid fa-circle" style="font-size:.45rem;"></i> Lowongan</span>
        </div>
        <span class="stat-value">{{ $totals['loker_aktif'] }}</span>
        <span class="stat-label">Loker Aktif</span>
        <span class="stat-foot">Lihat data loker <i class="fa-solid fa-arrow-right"></i></span>
    </a>

    <a href="{{ route('status_pelamar') }}" class="stat-card stat-indigo">
        <div class="stat-top">
            <span class="stat-icon"><i class="fa-solid fa-users"></i></span>
            <span class="stat-tag"><i class="fa-solid fa-circle" style="font-size:.45rem;"></i> Pelamar</span>
        </div>
        <span class="stat-value">{{ $totals['pendaftar'] }}</span>
        <span class="stat-label">Total Pendaftar</span>
        <span class="stat-foot">Lihat status pelamar <i class="fa-solid fa-arrow-right"></i></span>
    </a>

    <a href="{{ route('status_pelamar') }}" class="stat-card stat-amber">
        <div class="stat-top">
            <span class="stat-icon"><i class="fa-solid fa-clock"></i></span>
            <span class="stat-tag"><i class="fa-solid fa-circle" style="font-size:.45rem;"></i> Perlu Dicek</span>
        </div>
        <span class="stat-value">{{ $totals['menunggu'] }}</span>
        <span class="stat-label">Menunggu Verifikasi</span>
        <span class="stat-foot">Verifikasi pembayaran <i class="fa-solid fa-arrow-right"></i></span>
    </a>

    <a href="/laporan/download" class="stat-card stat-green">
        <div class="stat-top">
            <span class="stat-icon"><i class="fa-solid fa-money-bill-wave"></i></span>
            <span class="stat-tag">{{ $totals['sudah'] }} lunas</span>
        </div>
        <span class="stat-value"><small>Rp</small> {{ number_format($totals['omset'], 0, ',', '.') }}</span>
        <span class="stat-label">Omset Lunas</span>
        <span class="stat-foot">Unduh laporan <i class="fa-solid fa-arrow-right"></i></span>
    </a>
</div>

<div class="chart-grid">
    <div class="panel">
        <div class="panel-head">
            <div>
                <h2>Pendaftar per PT</h2>
                <p>Perbandingan status pembayaran setiap perusahaan.</p>
            </div>
        </div>
        <div class="panel-body panel-body--chart">
            <div class="chart-box">
                <canvas id="chartLoker"></canvas>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <div>
                <h2>Status Pembayaran</h2>
                <p>Distribusi status seluruh pendaftar.</p>
            </div>
        </div>
        <div class="panel-body panel-body--chart">
            <div class="chart-box">
                <canvas id="chartStatus"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Tren 14 Hari</h2>
            <p>Jumlah pendaftar baru dalam dua minggu terakhir.</p>
        </div>
    </div>
    <div class="panel-body panel-body--chart">
        <div class="chart-box chart-box--sm">
            <canvas id="chartTren"></canvas>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-head">
        <div>
            <h2>Rincian per PT</h2>
            <p>Rekap pendaftar berdasarkan lowongan yang tersedia.</p>
        </div>
        <a href="/laporan/download" class="btn btn-light btn-sm">
            <i class="fa-solid fa-file-arrow-down"></i>
            Download Semua
        </a>
    </div>
    <div class="panel-body panel-body--flush">
        <div class="table-responsive">
            <table class="bkk-table">
                <thead>
                    <tr>
                        <th>Nama PT</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Belum</th>
                        <th>Menunggu</th>
                        <th>Sudah</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lokerData as $data)
                        <tr>
                            <td>
                                <span class="table-company">{{ $data->nama_loker }}</span>
                            </td>
                            <td>{{ $data->posisi }}</td>
                            <td>
                                @if ($data->status_loker === 'aktif')
                                    <span class="pill pill-success">Aktif</span>
                                @else
                                    <span class="pill pill-muted">Tidak Aktif</span>
                                @endif
                            </td>
                            <td><b>{{ $data->total }}</b></td>
                            <td>{{ $data->belum_bayar }}</td>
                            <td>{{ $data->menunggu }}</td>
                            <td>{{ $data->sudah_bayar }}</td>
                            <td>
                                <a href="{{ route('status_pelamar', ['loker_id' => $data->id_loker]) }}" class="btn btn-info btn-sm">
                                    Lihat Pendaftar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada data pendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
const lokerLabels = @json($lokerData->pluck('nama_loker'));
const lokerSudah = @json($lokerData->pluck('sudah_bayar'));
const lokerMenunggu = @json($lokerData->pluck('menunggu'));
const lokerBelum = @json($lokerData->pluck('belum_bayar'));

const bkkChartFont = { family: 'Inter, system-ui, sans-serif', size: 11 };
const bkkChartGrid = 'rgba(15, 58, 102, .07)';
const bkkChartTicks = '#8ba0b6';

if (document.getElementById('chartLoker')) {
    new Chart(document.getElementById('chartLoker'), {
        type: 'bar',
        data: {
            labels: lokerLabels,
            datasets: [
                { label: 'Sudah', data: lokerSudah, backgroundColor: '#12a975', borderRadius: 5, maxBarThickness: 26 },
                { label: 'Menunggu', data: lokerMenunggu, backgroundColor: '#f4b400', borderRadius: 5, maxBarThickness: 26 },
                { label: 'Belum', data: lokerBelum, backgroundColor: '#d33d4d', borderRadius: 5, maxBarThickness: 26 },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 7, font: bkkChartFont } },
            },
            scales: {
                x: { stacked: true, grid: { display: false }, ticks: { font: bkkChartFont, color: bkkChartTicks } },
                y: { stacked: true, beginAtZero: true, grid: { color: bkkChartGrid }, ticks: { font: bkkChartFont, color: bkkChartTicks, precision: 0 } },
            }
        }
    });
}

if (document.getElementById('chartStatus')) {
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: ['Belum', 'Menunggu', 'Sudah'],
            datasets: [{
                data: [{{ $totals['belum'] }}, {{ $totals['menunggu'] }}, {{ $totals['sudah'] }}],
                backgroundColor: ['#d33d4d', '#f4b400', '#12a975'],
                borderWidth: 0,
                hoverOffset: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 7, font: bkkChartFont } },
            }
        }
    });
}

if (document.getElementById('chartTren')) {
    new Chart(document.getElementById('chartTren'), {
        type: 'line',
        data: {
            labels: @json($tren->pluck('tgl')),
            datasets: [{
                label: 'Pendaftar',
                data: @json($tren->pluck('total')),
                borderColor: '#0b6bcb',
                backgroundColor: 'rgba(43, 140, 223, .12)',
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#0b6bcb',
                pointBorderWidth: 2,
                pointRadius: 3,
                fill: true,
                tension: .35,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: bkkChartFont, color: bkkChartTicks } },
                y: { beginAtZero: true, grid: { color: bkkChartGrid }, ticks: { font: bkkChartFont, color: bkkChartTicks, precision: 0 } },
            }
        }
    });
}
</script>
@endsection
