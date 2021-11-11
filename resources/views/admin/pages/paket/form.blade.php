@extends('admin.layout.container')

@section('title')
    @if ($paket->id_paket)
        Edit Paket {{ $paket->nama_paket }} - ELITES Admin
    @else
        Tambah Paket - ELITES Admin
    @endif
@stop
@section('content')

    <form action="@if ($paket->id_paket) /admin/paket/edit/{{ $paket->id_paket }} @else /admin/paket/tambah @endif" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/paket">Paket Membership</a></li>
                    @if ($paket && $paket->id_paket)
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $paket->nama_paket }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    @endif
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">@if ($paket->id_paket) Edit Membership @else Tambah Membership @endif</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Membership</label>
                                <input class="form-control" type="text" name="nama_paket" placeholder="Nama Membership"
                                    value="{{ $paket->nama_paket }}" required>
                            </div>
                            <div class="form-group">
                                <label>Biaya Membership</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input class="form-control" type="number" name="harga_member" placeholder="0"
                                        value="{{ $paket->harga_member }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi_paket"
                                    class="ckeditor">{{ $paket->deskripsi_paket }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Lainnya</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Masa Berlaku</label>
                                <select name="masa_berlaku" class="form-control" required>

                                    @foreach ($masa_berlaku as $masa)
                                        @if ($masa->tipe_masa == 'Free' || $masa->tipe_masa == 'Selamanya')
                                            <option
                                                {{ $paket && $paket->masa_berlaku == $masa->tipe_masa ? 'selected' : '' }}
                                                value="{{ $masa->tipe_masa }}">{{ $masa->tipe_masa }}</option>
                                        @else
                                            <option
                                                {{ $paket && $paket->masa_berlaku == $masa->jumlah_masa . ' ' . $masa->tipe_masa ? 'selected' : '' }}
                                                value="{{ $masa->jumlah_masa }} {{ $masa->tipe_masa }}">
                                                {{ $masa->jumlah_masa }} {{ $masa->tipe_masa }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jadikan Default Paket</label>
                                <select name="default" class="form-control">
                                    <option value="0" {{ $paket && $paket->default == 0 ? 'selected' : '' }}>Tidak
                                    </option>
                                    <option value="1" {{ $paket && $paket->default == 1 ? 'selected' : '' }}>Ya</option>
                                </select>
                                <small class="text-muted">Jika "Ya", maka akan menjadi default paket untuk member
                                    baru</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Urutan</label>
                                <input class="form-control" type="number" min="0" max="100" name="order"
                                    placeholder="1 - 100" value="{{ $paket->order }}" required>
                                <small class="text-muted">Urutan paket dari terkecil s/d terbesar</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Slug</label>
                                <input class="form-control" type="text" name="slug" placeholder="slug url"
                                    value="{{ $paket->slug }}" required>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Thumbnail</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div id="input-upload" name="foto_paket" label="Upload Foto"
                                    image="{{ $paket && $paket->foto_paket ? '/assets/foto/paket/' . $paket->foto_paket : '/assets/img/nofoto.png' }}">
                                </div>
                                <small class="text-muted">Rekomendasi 600x450</small>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <input type="submit" value="POSTING" class="btn btn-primary" name="simpan">
                            <input type="submit" value="DRAFT" name="simpan" class="btn btn-secondary">
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
