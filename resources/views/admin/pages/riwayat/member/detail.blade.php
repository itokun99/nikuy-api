@extends('admin.layout.container')

@section('title')
    Detail {{ $riwayat->id }} - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/riwayat-member">Riwayat Member</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $riwayat->id }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Detail Riwayat</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">ID</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $riwayat->id }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Member</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        <a href="/admin/member/{{ $riwayat->user->id_user }}">
                                            {{ $riwayat->user->nama_user }}
                                        </a>
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Deskripsi</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $riwayat->deskripsi }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Timestamp</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $riwayat->created_at }}</p>
                                </div>

                                @if ($riwayat->detail)
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                        <p class="font-weight-bold m-0">Detail</p>
                                    </div>

                                    @php
                                        $detail = json_decode($riwayat->detail);
                                        
                                    @endphp
                                    <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                        <p class="m-0">
                                        <ul>
                                            @foreach ($detail as $k => $v)
                                                <li>{{ $k }}: {{ $v }}</li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
