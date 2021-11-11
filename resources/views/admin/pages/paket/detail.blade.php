@extends('admin.layout.container')

@section('title')
    Paket {{ $paket->nama_paket }} - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/paket">Paket Membership</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $paket->nama_paket }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Foto</strong></h6>
                    </div>
                    <div class="card-body">
                        <img class="w-100"
                            src="{{ $paket->foto ? '/assets/foto/paket/' . $paket->foto_paket : '/assets/img/nofoto.png' }}"
                            alt="foto" />
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Informasi Paket</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">ID</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $paket->id_paket }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Nama Paket</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $paket->nama_paket }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Masa Berlaku</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $paket->masa_berlaku }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">URL Slug</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $paket->slug }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Kondisi</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        <span
                                            class="badge {{ $paket->kondisi == 'DRAFT' ? 'badge-secondary' : 'badge-primary' }}">{{ $paket->kondisi }}</span>
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Total Member</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $memberCount }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Dibuat pada</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $paket->created_at)->translatedFormat('H:i, d F Y') }}
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Terakhir diperbarui</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $paket->updated_at)->translatedFormat('H:i, d F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Deskripsi</strong></h6>
                    </div>
                    <div class="card-body">
                        {!! $paket->deskripsi_paket !!}
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card  shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Member</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-3">
                            <table class='table table-bordered table-hover'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Foto</th>
                                        <th style="min-width:150px">Nama</th>
                                        <th style="min-width:300px">Alamat</th>
                                        <th style="min-width:200px">E-Mail</th>
                                        <th>Telepon</th>
                                        <th style="min-width:150px">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($members && count($members) > 0)
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{ $member->id_user }}</td>
                                                <td>
                                                    <img class='rounded-circle'
                                                        src="{{ $member->foto == 'Kosong' ? '/assets/img/nofoto.png' : '/uploads/photo/' . $member->foto }}"
                                                        width='50' height='50' />
                                                </td>
                                                <td>
                                                    {{ $member->nama_user }}
                                                </td>
                                                <td>{{ $member->alamat }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->no_hp }}</td>
                                                <td>
                                                    @if ($member->status == 'Aktif')
                                                        <span class="badge badge-success">{{ $member->status }}</span>
                                                    @elseif($member->status == 'Deactive')
                                                        <span class="badge badge-danger">{{ $member->status }}</span>
                                                    @endif
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
                                                                href='/admin/member/{{ $member->id_user }}'>Detail</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada member</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $members->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
