@extends('admin.layout.container')

@section('title')
    Masa Berlaku - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Masa Berlaku</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Masa Berlaku</h6>
                    </div>
                    <div class="card-body">

                        <form action="/admin/masa-berlaku/tambah" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Tipe Masa</label>
                                <select name="tipe_masa" class="form-control" required>
                                    <option value="Free">Free</option>
                                    <option value="Hari">Hari</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                    <option value="Selamanya">Selamanya</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Jumlah Masa</label>
                                <input type="number" class="form-control" name="jumlah_masa" placeholder="0" />
                                <small class="text-muted">Isi jumlah masa jika memilih Hari/Bulan/Tahun</small>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Deactive">Deactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Masa Berlaku</h6>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>Masa Berlaku</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($masa_berlaku && count($masa_berlaku) > 0)
                                        @foreach ($masa_berlaku as $item)
                                            <tr>
                                                <td>{{ $item->tipe_masa == 'Free' || $item->tipe_masa == 'Selamanya' ? $item->tipe_masa : $item->jumlah_masa . ' ' . $item->tipe_masa }}
                                                </td>
                                                <td>
                                                    @switch($item->status)
                                                        @case('Aktif')
                                                            <span class="badge badge-primary">{{ $item->status }}</span>
                                                        @break
                                                        @case('Deactive')
                                                            <span class="badge badge-secondary">{{ $item->status }}</span>
                                                        @break

                                                        @default
                                                    @endswitch
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
                                                                data-target='#masa-berlaku-{{ $item->id }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href="/admin/masa-berlaku/delete/{{ $item->id }}">Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class='modal fade' id='masa-berlaku-{{ $item->id }}' tabindex='-1'
                                                role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title'>Edit Masa Berlaku</h5>
                                                            <button type='button' class='close' data-dismiss='modal'
                                                                aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <form action="/admin/masa-berlaku/edit/{{ $item->id }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Tipe Masa</label>
                                                                    <select name="tipe_masa" class="form-control"
                                                                        required>
                                                                        <option value="Free"
                                                                            {{ $item->tipe_masa == 'Free' ? 'selected' : '' }}>
                                                                            Free</option>
                                                                        <option value="Hari"
                                                                            {{ $item->tipe_masa == 'Hari' ? 'selected' : '' }}>
                                                                            Hari</option>
                                                                        <option value="Bulan"
                                                                            {{ $item->tipe_masa == 'Bulan' ? 'selected' : '' }}>
                                                                            Bulan</option>
                                                                        <option value="Tahun"
                                                                            {{ $item->tipe_masa == 'Tahun' ? 'selected' : '' }}>
                                                                            Tahun</option>
                                                                        <option value="Selamanya"
                                                                            {{ $item->tipe_masa == 'Selamanya' ? 'selected' : '' }}>
                                                                            Selamanya</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Jumlah Masa</label>
                                                                    <input type="number" class="form-control"
                                                                        name="jumlah_masa" placeholder="0"
                                                                        value="{{ $item->jumlah_masa }}" />
                                                                    <small class="text-muted">Isi jumlah masa jika
                                                                        memilih Hari/Bulan/Tahun</small>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Status</label>
                                                                    <select name="status" class="form-control" required>
                                                                        <option value="Aktif"
                                                                            {{ $item->status == 'Aktif' ? 'selected' : '' }}>
                                                                            Aktif</option>
                                                                        <option value="Deactive"
                                                                            {{ $item->status == 'Deactive' ? 'selected' : '' }}>
                                                                            Deactive</option>
                                                                    </select>
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
