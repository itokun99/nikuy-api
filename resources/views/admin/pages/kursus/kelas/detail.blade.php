@extends('admin.layout.container')

@section('title')
    Kelas {{ $kelas->nama_kelas }} - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/kelas">Kelas</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $kelas->nama_kelas }}</li>
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
                        @if ($kelas && $kelas->foto_kelas && $kelas->foto_kelas != 'Kosong')
                            <img class="w-100" src="/assets/foto/kelas/{{ $kelas->foto_kelas }}" alt="foto" />
                        @else
                            <img class="w-100" src="/assets/img/nofoto.png" alt="foto" />
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Informasi Kelas</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">ID</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $kelas->id_kelas }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Nama Kelas</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $kelas->nama_kelas }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Order</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $kelas->order_id }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Jumlah Pelajaran</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        @if ($jumlahPelajaran && $jumlahPelajaran > 0)
                                            {{ $jumlahPelajaran }} Pelajaran
                                        @else
                                            Tidak ada pelajaran
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Pesan Singkat</strong></h6>
                    </div>
                    <div class="card-body">
                        {!! $kelas->pesan !!}
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Deskripsi</strong></h6>
                    </div>
                    <div class="card-body">
                        {!! $kelas->deskripsi !!}
                    </div>
                </div>

                @if ($kursus && count($kursus) > 0)

                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pelajaran</h6>
                        </div>
                        <div class="card-body">
                            <div class='table-responsive'>
                                <table class='table table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th>ID</th>
                                            <th>Thumbnail</th>
                                            <th>Nama Pelajaran</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kursus as $key => $pelajaran)
                                            <tr>
                                                <td>{{ $pelajaran->id_kursus }}</td>
                                                <td>
                                                    <img src='/assets/foto/kursus/{{ $pelajaran->foto_kursus }}'
                                                        width='100' />
                                                </td>
                                                <td> {{ $pelajaran->nama_kursus }}</td>
                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>

                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item modal-view'
                                                                href='/admin/kursus/{{ $pelajaran->id_kursus }}'>Detail</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                {!! $kursus->links() !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
