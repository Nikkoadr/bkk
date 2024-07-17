@extends('layouts.main_admin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
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
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama PT</th>
                            <th>Pendaftar Belum Bayar</th>
                            <th>Pendaftar Menunggu</th>
                            <th>Pendaftar Sudah Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lokerData as $data)
                        <tr>
                            <td>{{ $data->nama_loker }}</td>
                            <td>{{ $data->belum_bayar }}</td>
                            <td>{{ $data->menunggu }}</td>
                            <td>{{ $data->sudah_bayar }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
