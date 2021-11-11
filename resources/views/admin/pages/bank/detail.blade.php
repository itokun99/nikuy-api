@extends('admin.layout.container')

@section('title')
    Bank {{ $bank->nama }} - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/bank">Daftar Bank</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $bank->nama }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Logo</strong></h6>
                    </div>
                    <div class="card-body">
                        <img class="w-100"
                            src="{{ $bank && $bank->logo ? '/assets/foto/img/' . $bank->logo : '/assets/img/nofoto.png' }}"
                            alt="foto" />
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Data Bank</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">ID</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $bank->id }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Nama Bank</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $bank->nama }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Kode Bank</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $bank->kode }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Status</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        <span
                                            class="badge {{ $bank->status == 'Aktif' ? 'badge-primary' : 'badge-secondary' }}">{{ $bank->status }}</span>
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Dibuat pada</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bank->created_at)->translatedFormat('H:i, d F Y') }}
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Terakhir diperbarui</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bank->updated_at)->translatedFormat('H:i, d F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Intruksi Pembayaran</strong></h6>
                    </div>
                    <div class="card-body">
                        {!! $bank->intruksi !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
