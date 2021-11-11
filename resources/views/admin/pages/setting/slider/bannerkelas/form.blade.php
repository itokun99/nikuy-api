@extends('admin.layout.container')

@section('title')
    @if ($banner)
        Edit Banner Kelas {{ $banner->judul }} - ELITES Admin
    @else
        Tambah Pembagian Kelas - ELITES Admin
    @endif
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/banner">Banner Kelas</a></li>
            @if ($banner)
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $banner->judul }}</li>
            @endif
        </ol>
    </nav>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">

                <div class="card shadow mb-4">
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">List Kursus</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="#" data-toggle="modal" class="btn btn-primary"
                                data-target="#modal-tambah-kursus">Tambah</a>
                        </div>
                        <div class='table-responsive'>
                            <table class='table table-bordered  table-hover'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>No</th>
                                        <th>Thumbnail</th>
                                        <th style="min-width:200px">Nama Kursus</th>
                                        <th>Kondisi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($bannerKursus && count($bannerKursus) > 0)
                                        @foreach ($bannerKursus as $key => $k)
                                            <tr>
                                                <td>{{ $k->order }}</td>
                                                <td>
                                                    @if ($k->kursus && $k->kursus->foto_kursus && $k->kursus->foto_kursus != 'Kosong')
                                                        <img src='/assets/foto/kursus/{{ $k->kursus->foto_kursus }}'
                                                            width='100' />
                                                    @else
                                                        <img src='/assets/img/nofoto.png' width='100' />
                                                    @endif

                                                </td>
                                                <td> {{ $k->kursus->nama_kursus }}</td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge {{ $k->kondisi == 'DRAFT' ? 'badge-secondary' : 'badge-primary' }}">{{ $k->kondisi }}</span>
                                                </td>
                                                <td>
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>

                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item modal-view'
                                                                href='/admin/kursus/{{ $k->kursus->id_kursus }}'>Detail</a>
                                                            <a class='dropdown-item' href='#' data-toggle='modal'
                                                                data-target="#modal-edit-kursus-{{ $k->id }}">Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/banner-kelas/{{ $banner->id }}/kursus/delete/{{ $k->id }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class='modal fade' id='modal-edit-kursus-{{ $k->id }}'
                                                tabindex='-1' role='dialog' aria-labelledby='modelTitleId'
                                                aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title'>Edit Banner Kursus</h5>
                                                            <button type='button' class='close' data-dismiss='modal'
                                                                aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <form
                                                                action="/admin/banner-kelas/{{ $banner->id }}/kursus/edit/{{ $k->id }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label class="form-label">Kursus</label>
                                                                    <select name="id_kursus" class="form-control"
                                                                        required>
                                                                        <option value="">Pilih Kursus</option>
                                                                        @foreach ($kursus as $j)
                                                                            <option value='{{ $j->id_kursus }}'
                                                                                {{ $k->id_kursus == $j->id_kursus ? 'selected' : '' }}>
                                                                                {{ $j->nama_kursus }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Urutan</label>
                                                                    <input type="number" class="form-control" name="order"
                                                                        placeholder="0" value="{{ $k->order }}" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Kondisi</label>
                                                                    <select class="form-control" name="kondisi" required>
                                                                        <option value="POSTING"
                                                                            {{ $k->kondisi == 'POSTING' ? 'selected' : '' }}>
                                                                            Posting</option>
                                                                        <option value="DRAFT"
                                                                            {{ $k->kondisi == 'DRAFT' ? 'selected' : '' }}>
                                                                            Draft</option>
                                                                    </select>
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="8">Tidak ada</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Banner</h6>
                    </div>
                    <div class="card-body">
                        <form action="/admin/banner-kelas/edit/{{ $banner->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="judul" required
                                    value="{{ $banner->judul ?? '' }}" />
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kelas</label>
                                <select name="id_kelas" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $k)
                                        <option value='{{ $k->id_kelas }}'
                                            {{ $banner && $banner->id_kelas == $k->id_kelas ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Urutan</label>
                                <input type="number" class="form-control" name="order" placeholder="0"
                                    value="{{ $banner->order ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Kondisi</label>
                                <select class="form-control" name="kondisi" required>
                                    <option value="POSTING"
                                        {{ $banner && $banner->kondisi == 'POSTING' ? 'selected' : '' }}>
                                        Posting</option>
                                    <option value="DRAFT" {{ $banner && $banner->kondisi == 'DRAFT' ? 'selected' : '' }}>
                                        Draft</option>
                                </select>
                            </div>

                            <div class="form-group">

                                <label for="" class="form-label">Gambar</label>
                                <div id="input-upload" name="gambar" label="Upload Gambar"
                                    image="{{ $banner && $banner->gambar ? '/assets/foto/slider/' . $banner->gambar : '/assets/img/nofoto.png' }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class='modal fade' id='modal-tambah-kursus' tabindex='-1' role='dialog' aria-labelledby='modelTitleId'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Tambah Banner Kursus</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <form action="/admin/banner-kelas/{{ $banner->id }}/kursus/tambah" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Kursus</label>
                            <select name="id_kursus" class="form-control" required>
                                <option value="">Pilih Kursus</option>
                                @foreach ($kursus as $k)
                                    <option value='{{ $k->id_kursus }}'>
                                        {{ $k->nama_kursus }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Urutan</label>
                            <input type="number" class="form-control" name="order" placeholder="0" />
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Kondisi</label>
                            <select class="form-control" name="kondisi" required>
                                <option value="POSTING">Posting</option>
                                <option value="DRAFT">Draft</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@push('custom-js')
    @include('admin.component.input-upload')
@endpush
