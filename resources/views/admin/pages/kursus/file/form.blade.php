@extends('admin.layout.container')

@section('title')
    @if ($kursus)
        Edit file kursus {{ $kursus->nama_kursus }} - ELITES Admin
    @else
        Tambah File Kursus - ELITES Admin
    @endif
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/file-kursus">File Kursus</a></li>

            @if ($kursus)
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $kursus->nama_kursus }}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Tambah File Kursus</li>
            @endif
        </ol>
    </nav>
@stop

@section('content')
    <form action="@if ($kursus) /admin/file-kursus/edit/{{ $kursus->id_kursus }} @else /admin/file-kursus/tambah @endif" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Info File Kursus</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama</label>
                                <input class="form-control" type="text" name="nama_kursus"
                                    value="{{ $kursus->nama_kursus ?? '' }}" placeholder="Nama" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">File</label>
                                <div class="custom-file">
                                    <input id="gambarAmbil" type="file" name="file_kursus" class="custom-file-input"
                                        id="customFile">
                                    <label class="custom-file-label" for="customFile">Upload</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Klasifikasi</h6>
                        </div>

                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label">Paket</label>
                                <select name="id_paket" class="form-control" required>
                                    <option value="" disabled>Pilih Paket</option>
                                    @foreach ($pmember as $pm)
                                        <option value='{{ $pm->id_paket }}' @if ($kursus && $kursus->id_paket == $pm->id_paket) selected @endif>
                                            {{ $pm->nama_paket }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Kelas</label>
                                <select name="id_kelas" class="form-control" required>
                                    <option value="" disabled>Pilih Kelas</option>
                                    @foreach ($kelas as $kelass)
                                        <option value='{{ $kelass->id_kelas }}' @if ($kursus && $kursus->id_kelas == $kelass->id_kelas) selected @endif>
                                            {{ $kelass->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Pilar</label>
                                <select name="id_pilar" class="form-control" required>
                                    <option value="" disabled>Pilih Pilar</option>
                                    @foreach ($pilar as $pilars)
                                        <option value='{{ $pilars->id_pilar }}' @if ($kursus && $kursus->id_pilar == $pilars->id_pilar) selected @endif>
                                            {{ $pilars->nama_pilar }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Urutan</label>
                                <input type="number" class="form-control" name="order_id" placeholder="0"
                                    value="{{ $kursus->order_id ?? '' }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <input type="submit" value="POSTING" class="btn btn-primary" name="kondisi">
                            <input type="submit" value="DRAFT" class="btn btn-secondary" name="kondisi">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
