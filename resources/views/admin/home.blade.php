@extends('layouts.main_admin')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>dashboard</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Data loker</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                        <canvas id="barChart" ></canvas>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var lokerData = @json($lokerData);
        var labels = lokerData.map(item => item.nama_loker);
        var dataSudahDaftar = lokerData.map(item => item.sudah_bayar);
        var dataMenungguKonfirmasi = lokerData.map(item => item.menunggu);
        var dataBelumDaftar = lokerData.map(item => item.belum_bayar);
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Sudah Daftar',
                        data: dataSudahDaftar,
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        borderWidth: 1
                    },
                    {
                        label: 'Menunggu Konfirmasi',
                        data: dataMenungguKonfirmasi,
                        backgroundColor: 'rgba(255,193,7,0.9)',
                        borderColor: 'rgba(255,193,7,0.8)',
                        borderWidth: 1
                    },
                    {
                        label: 'Belum Daftar',
                        data: dataBelumDaftar,
                        backgroundColor: 'rgba(220,53,69,0.9)',
                        borderColor: 'rgba(220,53,69,0.8)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
