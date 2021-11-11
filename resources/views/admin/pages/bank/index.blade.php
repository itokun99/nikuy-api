@extends('admin.layout.container')

@section('title')
    Daftar Bank - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Bank</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Bank</h6>
                    </div>

                    <div class="card-body">

                        <div class="mb-4">
                            <a class='btn btn-primary' href='/admin/bank/tambah/'>Tambah</a>
                        </div>

                        <div class='table-responsive table-hover'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th style="min-width:50px">Logo</th>
                                        <th style="min-width:150px">Nama Bank</th>
                                        <th style="min-width:150px">Kode</th>
                                        <th style="min-width:150px">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($banks && count($banks) > 0)
                                        @foreach ($banks as $key => $bank)
                                            <tr>
                                                <td>{{ $bank->id }}</td>
                                                <td>
                                                    @if ($bank->logo)
                                                        <a href='/assets/foto/img/{{ $bank->logo }}'>
                                                            <img src='/assets/foto/img/{{ $bank->logo }}' width='75' />
                                                        </a>
                                                    @else
                                                        <img src='/assets/img/nofoto.png' width='75' />
                                                    @endif
                                                </td>
                                                <td>{{ $bank->nama }}</td>
                                                <td>{{ $bank->kode }}</td>
                                                <td class="text-center"><span
                                                        class="badge {{ $bank->status == 'Aktif' ? 'badge-primary' : 'badge-secondary' }}">{{ $bank->status }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>
                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item modal-view'
                                                                href='/admin/bank/{{ $bank->id }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/bank/edit/{{ $bank->id }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/bank/delete/{{ $bank->id }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="7">
                                                Tidak ada
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $banks->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
