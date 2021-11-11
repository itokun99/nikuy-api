@extends('admin.layout.container')

@section('title')
    @if ($bank)
        Edit Bank {{ $bank->nama }} - ELITES Admin
    @else
        Tambah Bank - ELITES Admin
    @endif
@stop
@section('content')
    <form action="@if ($bank) /admin/bank/edit/{{ $bank->id }} @else /admin/bank/tambah @endif" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/bank">Daftar Bank</a></li>
                    @if ($bank)
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $bank->nama }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    @endif
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Bank</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Bank</label>
                                <input class="form-control" type="text" name="nama" placeholder="Masukan nama bank"
                                    value="{{ $bank->nama ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label>Kode Bank (opsional)</label>
                                <input class="form-control" type="text" name="kode" placeholder="Masukan kode bank"
                                    value="{{ $bank->kode ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>Intruksi</label>
                                <textarea name="intruksi" class="ckeditor">{{ $bank->intruksi ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Status</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select name="status" class="form-control" required>
                                    <option value="Aktif" {{ $bank && $bank->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="Nonaktif" {{ $bank && $bank->status == 'Nonaktif' ? 'selected' : '' }}>
                                        Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Logo</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div id="input-upload" name="logo" label="Upload Foto"
                                    image="{{ $bank && $bank->logo ? '/assets/foto/img/' . $bank->logo : '/assets/img/nofoto.png' }}">
                                </div>
                                <small class="text-muted">Rekomendasi 600x450</small>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop


@push('custom-js')
    @include('admin.component.editorscript')
    @include('admin.component.input-upload')
@endpush
