@extends('admin.layout.container')

@section('title')
    Sosial Media - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sosial Media</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Sosial Media</h6>
                    </div>
                    <div class="card-body">

                        <form action="/admin/sosial-media/tambah" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Nama Sosial Media</label>
                                <input type="text" class="form-control" name="nama_sosmed"
                                    placeholder="Masukkan disini..." required />
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Nama Akun</label>
                                <input type="text" class="form-control" name="akun" placeholder="Masukkan disini..."
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Url</label>
                                <input type="text" class="form-control" name="link_sosmed"
                                    placeholder="Masukkan disini..." required />
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Logo</label>
                                <div class="input-upload" name="logo" label="Upload Logo" image="/assets/img/nofoto.png">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Sosial Media</h6>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>logo</th>
                                        <th>Nama Sosmed</th>
                                        <th>Nama Akun</th>
                                        <th>Url</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($sosmed && count($sosmed) > 0)
                                        @foreach ($sosmed as $sosial)
                                            <tr>
                                                <td>
                                                    <img src="{{ !$sosial->logo_sosmed ? '/assets/img/nofoto.png' : '/assets/foto/sosmed/' . $sosial->logo_sosmed }}"
                                                        width='50' height='50' />
                                                </td>
                                                <td>{{ $sosial->nama_sosmed }}</td>
                                                <td>{{ $sosial->akun }}</td>
                                                <td>
                                                    <a href="{{ $sosial->link_sosmed }}">{{ $sosial->link_sosmed }}</a>
                                                </td>
                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>
                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item' href='#' data-toggle='modal'
                                                                data-target='#sosmed{{ $sosial->id_sosmed }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href="/admin/sosial-media/delete/{{ $sosial->id_sosmed }}">Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class='modal fade' id='sosmed{{ $sosial->id_sosmed }}' tabindex='-1'
                                                role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title'>Edit Sosial Media</h5>
                                                            <button type='button' class='close' data-dismiss='modal'
                                                                aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <form
                                                                action="/admin/sosial-media/edit/{{ $sosial->id_sosmed }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Nama Sosial
                                                                        Media</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama_sosmed" placeholder="Masukkan disini..."
                                                                        required value="{{ $sosial->nama_sosmed }}" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Nama Akun</label>
                                                                    <input type="text" class="form-control" name="akun"
                                                                        placeholder="Masukkan disini..." required
                                                                        value="{{ $sosial->akun }}" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Url</label>
                                                                    <input type="text" class="form-control"
                                                                        name="link_sosmed" placeholder="Masukkan disini..."
                                                                        required value="{{ $sosial->link_sosmed }}" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Logo</label>
                                                                    <div class="input-upload" name="logo"
                                                                        label="Upload Logo"
                                                                        image="{{ $sosial && $sosial->logo_sosmed ? '/assets/foto/sosmed/' . $sosial->logo_sosmed : '/assets/img/nofoto.png' }}">
                                                                    </div>
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary">SIMPAN</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">Tidak ada</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('custom-js')
    @include('admin.component.input-upload')
@endpush
