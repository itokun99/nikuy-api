@extends('admin.layout.container')

@section('title')
    Rating {{ $rating->id_rating }} - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/rating">Rating</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $rating->id_rating }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Informasi Rating</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">ID</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $rating->id_rating }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Member</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        <a
                                            href="/admin/member/{{ $rating->user->id_user }}">{{ $rating->user->nama_user }}</a>
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Kelas</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        <a
                                            href="/admin/kelas/{{ $rating->kelas->id_kelas }}">{{ $rating->kelas->nama_kelas }}</a>
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Nilai Rating</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $rating->level_rating }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Dibuat pada</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ $rating->created_at ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $rating->created_at)->translatedFormat('H:i, d F Y') : '-' }}
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Komentar</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        {{ $rating->komentar }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
