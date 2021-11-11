@extends('admin.layout.container')

@section('title')
    Transaksi {{ $transaksi->id_user }} - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/transaksi">Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $transaksi->id_transaksi }}</li>
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
                        <h6 class="m-0 text-primary"><strong>Foto</strong></h6>
                    </div>
                    <div class="card-body">
                        <img class="w-100"
                            src="{{ $transaksi->foto_struk ? '/assets/foto/struk/' . $transaksi->foto_struk : '/assets/img/nofoto.png' }}"
                            alt="foto" />
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Informasi</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">ID</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $transaksi->id_transaksi }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Nama Transaksi</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $transaksi->nama_transaksi }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Member</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        <a href="/admin/member/{{ $transaksi->user->id_user }}">
                                            {{ $transaksi->user->nama_user }}
                                        </a>
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Rekening</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        {{ $transaksi->no_rek }}
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Bank Asal</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        {{ $transaksi->bank_asal }}
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Pemilik Rekening</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        {{ $transaksi->nama_rekening }}
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Biaya Transaksi</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        Rp. {{ number_format($transaksi->biaya_transaksi, 2, ',', '.') }}
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Keterangan</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        @if ($transaksi->keterangan == 'Ok')
                                            <span class='badge badge-success'>{{ $transaksi->keterangan }}</span>
                                        @elseif ($transaksi->keterangan == 'Expired')
                                            <span class='badge badge-danger'>{{ $transaksi->keterangan }}</span>
                                        @elseif ($transaksi->keterangan == 'Menunggu')
                                            <span class='badge badge-info'>{{ $transaksi->keterangan }}</span>
                                        @elseif ($transaksi->keterangan == 'Ditolak')
                                            <span class='badge badge-warning'>{{ $transaksi->keterangan }}</span>
                                        @endif
                                    </p>
                                </div>

                                @if ($transaksi->paket)
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                        <p class="font-weight-bold m-0">Paket</p>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                        <a
                                            href="/admin/paket/{{ $transaksi->paket->id_paket }}">{{ $transaksi->paket->nama_paket }}</a>
                                    </div>
                                @endif

                                @if ($transaksi->event)
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                        <p class="font-weight-bold m-0">Event</p>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                        <a
                                            href="/admin/event/{{ $transaksi->event->id_event }}">{{ $transaksi->event->nama_event }}</a>
                                    </div>
                                @endif

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Tanggal Transaksi</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ $transaksi->tgl_transaksi ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->tgl_transaksi)->translatedFormat('d F Y') : '-' }}
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Tanggal Berakhir</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ $transaksi->tgl_berakhir ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->tgl_berakhir)->translatedFormat('d F Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
