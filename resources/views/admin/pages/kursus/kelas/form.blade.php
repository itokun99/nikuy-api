@extends('admin.layout.container')

@section('title')
    @if ($kelas)
        Edit kelas {{ $kelas->id_kelas }} - ELITES Admin
    @else
        Tambah Kelas - ELITES Admin
    @endif
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/kelas">Kelas</a></li>

            @if ($kelas)
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $kelas->nama_kelas }}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Tambah Kelas</li>
            @endif
        </ol>
    </nav>
@stop

@section('content')
    <form action="@if ($kelas) /admin/kelas/edit/{{ $kelas->id_kelas }} @else /admin/kelas/tambah @endif " method="post" enctype="multipart/form-data">
        @csrf
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->

                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Kelas</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Nama Kelas</label>
                                <input class="form-control" type="text" name="nama_kelas"
                                    value="{{ $kelas->nama_kelas ?? '' }}" placeholder="Nama Kelas" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Urutan</label>
                                <input class="form-control" type="number" name="order_id"
                                    value="{{ $kelas->order_id ?? '' }}" placeholder="1-100" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi"
                                    class="form-control ckeditor">{{ $kelas->deskripsi ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">


                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Thumbnail</h6>
                        </div>
                        <div class="card-body">
                            <div id="input-upload" name="foto_kelas" label="Upload Foto"
                                image="{{ $kelas && $kelas->foto_kelas ? '/assets/foto/kelas/' . $kelas->foto_kelas : '/assets/img/nofoto.png' }}">
                            </div>
                            <small class="text-muted">Recommendation 600x450</small>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Deskripsi Singkat</h6>

                        </div>


                        <div class="card-body">

                            <div class="form-group">
                                <label for="my-textarea">Pesan Singkat:</label>
                                <textarea class="form-control ckeditor" name="pesan"
                                    rows="3"> {{ $kelas->pesan ?? '' }}</textarea>
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


@push('custom-js')
    @include('admin.component.editorscript')
    @include('admin.component.input-upload')
@endpush
