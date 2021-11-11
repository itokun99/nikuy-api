@extends('admin.layout.container')

@section('title')
    Pesan - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pesan</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Pesan Masuk</h6>
                    </div>

                    <div class="card-body">
                        <div class='table-responsive table-hover'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Pesan</th>
                                        <th>Status</th>
                                        <th>Timestamp</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pesan && count($pesan) > 0)
                                        @foreach ($pesan as $item)
                                            <tr>
                                                <td>{{ $item->id_kontak }}</td>
                                                <td>{{ $item->nama_kontak }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td class="text-center">
                                                    @switch($item->status)
                                                        @case('dibaca')
                                                            <span class="badge badge-success">{{ $item->status }}</span>
                                                        @break

                                                        @case('belum dibaca')
                                                            <span class="badge badge-warning">{{ $item->status }}</span>
                                                        @break

                                                        @default

                                                    @endswitch
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>
                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item'
                                                                href='/admin/pesan/{{ $item->id_kontak }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/pesan/delete/{{ $item->id_kontak }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="7">Tidak ada</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $pesan->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
