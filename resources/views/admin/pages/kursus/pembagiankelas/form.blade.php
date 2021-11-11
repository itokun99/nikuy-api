@extends('admin.layout.container')

@section('title')
    @if ($paket_kelas)
        Edit {{ $paket_kelas->id_paketkelas }} - ELITES Admin
    @else
        Tambah Pembagian Kelas - ELITES Admin
    @endif
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/pembagian-kelas">Pembagian Kelas</a></li>
            @if ($paket_kelas)
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $paket_kelas->id_paketkelas }}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Tambah Paket Kelas</li>
            @endif
        </ol>
    </nav>
@stop

@section('content')
    <form action="@if ($paket_kelas) /admin/pembagian-kelas/edit/{{ $paket_kelas->id_paketkelas }} @else /admin/pembagian-kelas/tambah @endif" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pembagian Kelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Paket Membership</label>
                                <select name="id_paket" class="form-control" required>
                                    <option value="">Pilih Paket</option>
                                    @foreach ($paket as $p)
                                        <option value='{{ $p->id_paket }}' @if ($paket_kelas && $paket_kelas->id_paket && $paket_kelas->id_paket == $p->id_paket) selected @endif>
                                            {{ $p->nama_paket }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kelas</label>
                                <select name="id_kelas" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $k)
                                        <option value='{{ $k->id_kelas }}' @if ($paket_kelas && $paket_kelas->id_kelas && $paket_kelas->id_kelas == $k->id_kelas) selected @endif>
                                            {{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
