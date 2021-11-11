@extends('admin.layout.container')

@section('title')
    @if ($payment)
        Edit Metode Pembayaran {{ $payment->bank ? $payment->bank->nama : $payment->id }} - ELITES Admin
    @else
        Tambah Metode Pembayaran - ELITES Admin
    @endif
@stop
@section('content')
    <form action="@if ($payment) /admin/metode-pembayaran/edit/{{ $payment->id }} @else /admin/metode-pembayaran/tambah @endif" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/metode-pembayaran">Metode Pembayaran</a></li>
                    @if ($payment)
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $payment->bank ? $payment->bank->nama : $payment->id }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    @endif
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Metode Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tipe Pembayaran</label>
                                <select name="tipe" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="Transfer Bank"
                                        {{ $payment && $payment->tipe == 'Transfer Bank' ? 'selected' : '' }}>
                                        Transfer Bank
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bank</label>
                                <select name="bank" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}"
                                            {{ $payment && $payment->bank && $bank && $bank->id == $payment->bank->id ? 'selected' : '' }}>
                                            {{ $bank->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nomor Rekening</label>
                                <input class="form-control" type="text" name="rekening"
                                    placeholder="Masukan nomor rekening" value="{{ $payment->rekening ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>Nama Pemilik Rekening</label>
                                <input class="form-control" type="text" name="pemilik"
                                    placeholder="Masukan nama pemilik rekening" value="{{ $payment->pemilik ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi"
                                    class="ckeditor">{{ $payment->deskripsi ?? '' }}</textarea>
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
                                    <option value="Aktif"
                                        {{ $payment && $payment->status == 'Aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="Nonaktif"
                                        {{ $payment && $payment->status == 'Nonaktif' ? 'selected' : '' }}>
                                        Nonaktif</option>
                                </select>
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
@endpush
