@extends('admin.layout.container')

@section('title')
    Dashboard - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
@stop

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Member Baru</div>

                                <div class='h5 mb-0 font-weight-bold text-gray-800'>
                                    {{ $totalNewMember > 0 ? $totalNewMember . ' member baru' : 'tidak ada' }}
                                </div>

                            </div>
                            <div class="col-auto">
                                <!--<i class="fas fa-calendar fa-2x text-gray-300"></i>-->
                                <i class="fa fa-user fa-2x text-gray-300" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total
                                    Transaksi</div>

                                <div class='h5 mb-0 font-weight-bold text-gray-800'>
                                    {{ $totalTransaksi > 0 ? $totalTransaksi . ' transaksi' : 'tidak ada' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <!--<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>-->
                                <i class="fas fa-money-bill   fa-2x text-gray-300 "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Kelas
                                </div>

                                <div class='h5 mb-0 font-weight-bold text-gray-800'>
                                    {{ $totalKelas > 0 ? $totalKelas . ' kelas' : 'tidak ada' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total
                                    Member</div>

                                <div class='h5 mb-0 font-weight-bold text-gray-800'>
                                    {{ $totalMember > 0 ? $totalMember . ' member' : 'tidak ada' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user-circle fa-2x text-gray-300" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--batas-------------------------------------------------------------->


        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <a href='/admin/transaksi/' class='btn btn-primary btn-sm'>Lihat Semua
                            Transaksi</a>
                        <br><br>
                        <div class='table-responsive'>
                            <table class='table table-sm small table-bordered table-hover' width='100%'>
                                <thead class='bg-dark text-white'>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Transaksi</th>
                                        <th>Biaya Transaksi</th>
                                        <th>Member</th>
                                        <th>Tanggal Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($transaksiTerbaru && count($transaksiTerbaru) > 0)
                                        @foreach ($transaksiTerbaru as $key => $transaksi)
                                            <tr>
                                                <td align='center'>{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $transaksi->nama_transaksi }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($transaksi->biaya_transaksi, 2, ',', '.') }}
                                                </td>
                                                <td><strong>{{ $transaksi->member ? $transaksi->member->nama_user : 'tanpa nama' }}</strong>
                                                </td>
                                                <td>{{ date('d F Y', strtotime($transaksi->tgl_transaksi)) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada transaksi</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Paket Membership</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if ($paketMember)
                            @foreach ($paketMember as $paket)
                                <a href='/admin/member/{{ $paket->slug }}' class='card mb-3 kartu'
                                    style='width: 100%; font-size:12px;'>
                                    <div class='row g-0'>
                                        <div class='col-md-5'>
                                            <center>
                                                <img src='/assets/foto/paket/{{ $paket->foto_paket }}' width='100%'
                                                    height='70' style='margin-top:15px;'>
                                            </center>
                                        </div>
                                        <div class='col-md-7'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>{{ $paket->nama_paket }}</h5>
                                                <p class='card-text'>
                                                    {{ $paket->memberCount > 0 ? $paket->memberCount . ' member' : 'tidak ada' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@stop
