@extends('admin.layout.container')

@section('title')
    Data Provinsi - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Provinsi</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Provinsi</h6>
                    </div>
                    <div class="card-body">

                        <form action="/admin/data-provinsi/tambah" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Masukkan Nama Provinsi</label>
                                <input type="text" class="form-control" name="nama_provinsi"
                                    placeholder="Masukkan disini..." required />
                            </div>
                            <p>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </p>
                        </form>

                    </div>
                </div>


            </div>

            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Provinsi</h6>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Provinsi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($provinsi as $key => $provinsis)
                                        <tr>
                                            <td>{{ $provinsis->id_provinsi }}</td>
                                            <td>
                                                {{ $provinsis->nama_provinsi }}
                                            </td>
                                            <td class="text-right">

                                                <div class='btn-group' role='group'>
                                                    <button id='aksi' type='button'
                                                        class='btn btn-secondary btn-sm dropdown-toggle'
                                                        data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    </button>
                                                    <div class='dropdown-menu' aria-labelledby='aksi'>
                                                        <a class='dropdown-item' href='#' data-toggle='modal'
                                                            data-target='#provinsi{{ $provinsis->id_provinsi }}'>Edit</a>
                                                        <a class='dropdown-item'
                                                            href='/admin/data-provinsi/delete/{{ $provinsis->id_provinsi }}'>Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class='modal fade' id='provinsi{{ $provinsis->id_provinsi }}' tabindex='-1'
                                            role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title'>Edit Provinsi</h5>
                                                        <button type='button' class='close' data-dismiss='modal'
                                                            aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <form
                                                            action='/admin/data-provinsi/edit/{{ $provinsis->id_provinsi }}'
                                                            method='post'>
                                                            @csrf
                                                            <div class='form-group'>
                                                                <label for=''>Masukkan Nama Provinsi</label>
                                                                <input value="{{ $provinsis->nama_provinsi }}" type='text'
                                                                    class='form-control' name='nama_provinsi'
                                                                    placeholder='Nama Provinsi' required />
                                                            </div>
                                                            <p>
                                                                <button type='submit'
                                                                    class='btn btn-primary'>SIMPAN</button>
                                                            </p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
