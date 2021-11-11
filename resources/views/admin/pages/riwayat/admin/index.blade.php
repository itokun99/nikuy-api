@extends('admin.layout.container')

@section('title')
    Riwayat Admin - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Admin</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat Aktifitas Admin</h6>
                    </div>

                    <div class="card-body">
                        <div class='table-responsive table-hover'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Timestamp</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($riwayat && count($riwayat) > 0)
                                        @foreach ($riwayat as $item)
                                            <tr>
                                                <td>
                                                    <a href="/admin/administrator/{{ $item->user->id_user }}">
                                                        {{ $item->user->nama_user }}
                                                    </a>
                                                </td>
                                                <td>{{ $item->deskripsi }}</td>
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
                                                                href='/admin/riwayat-admin/{{ $item->id }}'>Detail</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">Tidak ada</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $riwayat->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
