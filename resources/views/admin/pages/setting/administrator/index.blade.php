@extends('admin.layout.container')

@section('title')
    Administrator - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Administrator</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Administrator</h6>
                    </div>
                    <div class="card-body">
                        <a class='btn btn-primary mb-3' href='/admin/administrator/tambah/'>Tambah</a>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>E-Mail</th>
                                        <th>No. Handphone</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($administrator && count($administrator) > 0)
                                        @foreach ($administrator as $key => $administrators)

                                            <tr>
                                                <td>{{ $administrators->id_user }}</td>
                                                <td class="text-center">
                                                    @if ($administrators->foto && $administrators->foto != 'Kosong')
                                                        <a href='/uploads/photo/{{ $administrators->foto }}'
                                                            data-caption=''>
                                                            <img class='rounded-circle'
                                                                src="/uploads/photo/{{ $administrators->foto }}"
                                                                width='50' height='50' />
                                                        </a>
                                                    @else
                                                        <img class='rounded-circle' src="/assets/img/nofoto.png" width='50'
                                                            height='50' />
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $administrators->nama_user }}
                                                </td>
                                                <td>{{ $administrators->alamat }}</td>
                                                <td>{{ $administrators->email }}</td>
                                                <td>{{ $administrators->no_hp }}</td>
                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>
                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item'
                                                                href='/admin/administrator/{{ $administrators->id_user }}'>Detail</a>

                                                            @if (Auth::user()->hak_akses == 'Super Admin')
                                                                <a class='dropdown-item'
                                                                    href='/admin/administrator/edit/{{ $administrators->id_user }}'>Edit</a>
                                                                <a class='dropdown-item'
                                                                    href='/admin/administrator/delete/{{ $administrators->id_user }}'>Hapus</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="7">
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $administrator->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
