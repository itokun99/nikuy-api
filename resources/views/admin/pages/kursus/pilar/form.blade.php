@extends('admin.layout.container')

@section('title')
    @if ($pilar)
        Edit Pilar {{ $pilar->nama_pilar }} - ELITES Admin
    @else
        Tambah Pilar - ELITES Admin
    @endif
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/pilar">Pilar</a></li>

            @if ($pilar)
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $pilar->nama_pilar }}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Tambah Pilar</li>
            @endif
        </ol>
    </nav>
@stop

@section('content')
    <form action="@if ($pilar) /admin/pilar/edit/{{ $pilar->id_pilar }} @else /admin/pilar/tambah @endif" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->

                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Pilar</h6>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label class="form-label">Nama Pilar</label>
                                <input class="form-control" type="text" name="nama_pilar"
                                    value="{{ $pilar->nama_pilar ?? '' }}" placeholder="Nama Pilar" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="desk_pilar"
                                    class="form-control ckeditor">{{ $pilar->desk_pilar ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Pengelompokan Kelas</h6>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Kelas</label>
                                <select name="id_kelas" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $kelass)
                                        <option value='{{ $kelass->id_kelas }}' @if ($pilar && $pilar->id_kelas && $pilar->id_kelas == $kelass->id_kelas) selected @endif>
                                            {{ $kelass->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Urutan</label>
                                <input class="form-control" type="number" name="order_id"
                                    value="{{ $pilar->order_id ?? '' }}" placeholder="1-100" required>
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
@endpush
