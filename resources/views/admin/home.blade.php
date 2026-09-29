@extends('layouts.main_admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Dashboard</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">admin</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info"><div class="inner"><h3>{{ $totals['loker_aktif'] }}</h3><p>Loker Aktif</p></div><div class="icon"><i class="fas fa-building"></i></div><a href="{{ route('data_loker') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a></div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary"><div class="inner"><h3>{{ $totals['pendaftar'] }}</h3><p>Total Pendaftar</p></div><div class="icon"><i class="fas fa-users"></i></div><a href="{{ route('status_pelamar') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a></div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning"><div class="inner"><h3>{{ $totals['menunggu'] }}</h3><p>Menunggu Verifikasi</p></div><div class="icon"><i class="fas fa-clock"></i></div><a href="{{ route('status_pelamar') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a></div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success"><div class="inner"><h3>Rp {{ number_format($totals['omset'], 0, ',', '.') }}</h3><p>Omset Lunas ({{ $totals['sudah'] }})</p></div><div class="icon"><i class="fas fa-money-bill"></i></div><a href="/laporan/download" class="small-box-footer">Download <i class="fas fa-arrow-circle-right"></i></a></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card"><div class="card-header"><h3 class="card-title">Pendaftar per PT</h3></div>
                        <div class="card-body"><canvas id="chartLoker" height="120"></canvas></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card"><div class="card-header"><h3 class="card-title">Status Pembayaran</h3></div>
                        <div class="card-body"><canvas id="chartStatus" height="180"></canvas></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card"><div class="card-header"><h3 class="card-title">Tren 14 Hari</h3></div>
                        <div class="card-body"><canvas id="chartTren" height="80"></canvas></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Rincian per PT</h3><a href="/laporan/download" class="btn btn-primary btn-sm float-right">Download Seluruh Data</a></div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead><tr><th>Nama PT</th><th>Posisi</th><th>Status</th><th>Total</th><th>Belum</th><th>Menunggu</th><th>Sudah</th><th></th></tr></thead>
                        <tbody>
                            @foreach($lokerData as $data)
                            <tr>
                                <td>{{ $data->nama_loker }}</td>
                                <td>{{ $data->posisi }}</td>
                                <td>{{ $data->status_loker }}</td>
                                <td><b>{{ $data->total }}</b></td>
                                <td>{{ $data->belum_bayar }}</td>
                                <td>{{ $data->menunggu }}</td>
                                <td>{{ $data->sudah_bayar }}</td>
                                <td><a href="{{ route('status_pelamar', ['loker_id' => $data->id_loker]) }}" class="btn btn-sm btn-info">Lihat Pendaftar</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
const lokerLabels = @json($lokerData->pluck('nama_loker'));
const lokerSudah = @json($lokerData->pluck('sudah_bayar'));
const lokerMenunggu = @json($lokerData->pluck('menunggu'));
const lokerBelum = @json($lokerData->pluck('belum_bayar'));

new Chart(document.getElementById('chartLoker'), { type: 'bar',
    data: { labels: lokerLabels, datasets: [
        { label: 'Sudah', data: lokerSudah, backgroundColor: '#28a745' },
        { label: 'Menunggu', data: lokerMenunggu, backgroundColor: '#ffc107' },
        { label: 'Belum', data: lokerBelum, backgroundColor: '#dc3545' },
    ]},
    options: { responsive: true, scales: { x: { stacked: true }, y: { stacked: true, beginAtZero: true } } }
});

new Chart(document.getElementById('chartStatus'), { type: 'doughnut',
    data: { labels: ['Belum', 'Menunggu', 'Sudah'], datasets: [{ data: [{{ $totals['belum'] }}, {{ $totals['menunggu'] }}, {{ $totals['sudah'] }}], backgroundColor: ['#dc3545', '#ffc107', '#28a745'] }] }
});

new Chart(document.getElementById('chartTren'), { type: 'line',
    data: { labels: @json($tren->pluck('tgl')), datasets: [{ label: 'Pendaftar', data: @json($tren->pluck('total')), borderColor: '#0b6bcb', fill: false, tension: 0.3 }] },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
});
</script>
@endsection
