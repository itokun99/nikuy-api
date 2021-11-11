@extends('admin.layout.container')

@section('title')
    Kursus {{ $kursus->nama_kursus }} - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/kursus">Kursus</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $kursus->nama_kursus }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Foto</strong></h6>
                    </div>
                    <div class="card-body">
                        <img class="w-100"
                            src="{{ $kursus->foto == 'Kosong' ? '/assets/img/nofoto.png' : '/assets/foto/kursus/' . $kursus->foto_kursus }}"
                            alt="foto" />
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Data Kursus</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">ID</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $kursus->id_kursus }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Nama Kursus</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $kursus->nama_kursus }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Paket</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        @if ($kursus->paket && $kursus->paket->id_paket)
                                            <a href="/admin/paket/{{ $kursus->paket->id_paket }}">{{ $kursus->paket->nama_paket }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Kelas</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        @if ($kursus->kelas && $kursus->kelas->id_kelas)
                                            <a href="/admin/kelas/{{ $kursus->kelas->id_kelas }}">{{ $kursus->kelas->nama_kelas }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Pilar</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        @if ($kursus->pilar && $kursus->pilar->id_pilar)
                                            <a href="/admin/pilar/{{ $kursus->pilar->id_pilar }}">{{ $kursus->pilar->nama_pilar }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7">

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Deskripsi Kursus</strong></h6>
                    </div>
                    <div class="card-body">
                        {!! $kursus->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
