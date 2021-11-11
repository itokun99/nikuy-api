@extends('admin.layout.container')

@section('title')
    Member {{ $user->id_user }} - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/member">Member</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->nama_user }}</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Foto</strong></h6>
                    </div>
                    <div class="card-body">
                        <img class="w-100"
                            src="{{ !$user->foto || $user->foto == 'Kosong' ? '/assets/img/nofoto.png' : '/uploads/photo/' . $user->foto }}"
                            alt="foto" />
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Data Member</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">ID</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->id_user }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Nama</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->nama_user }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Alamat</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->alamat ?? '-' }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Provinsi</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        @if ($user->province && $user->province->id_provinsi)
                                            {{ $user->province->nama_provinsi }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Tanggal Lahir</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    @if ($user->tgl_lahir)
                                        <p class="m-0">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $user->tgl_lahir)->translatedFormat('d F Y') }}
                                        </p>
                                    @else
                                        <p class="m-0">
                                            -
                                        </p>
                                    @endif
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Jenis Kelamin</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->jenis_kelamin ?? '-' }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Email</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->email }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Hak Akses</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->hak_akses }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Title</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->title }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Summary</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->summary }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Status</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">{{ $user->status }}</p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Akun dibuat pada</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->translatedFormat('H:i, d F Y') }}
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Terakhir diperbarui</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->translatedFormat('H:i, d F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Membership</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class="container p-0 border border-1">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Jenis Membership</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    @if ($user->paket_membership && $user->paket_membership->paket)
                                        <p class="m-0">
                                            <a
                                                href="/admin/paket/{{ $user->paket_membership->paket->id_paket }}">{{ $user->paket_membership->paket->nama_paket }}</a>
                                        </p>
                                    @else
                                        <p class="m-0">Tidak ada</p>
                                    @endif
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Berlangganan pada</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        {{ $user->paket_membership && $user->paket_membership->subscribe_at ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->paket_membership->subscribe_at)->translatedFormat('H:i, d F Y') : '-' }}
                                    </p>
                                </div>

                                <div class="col-12 col-sm-12 col-md-4 col-lg-3 p-2 border border-1 bg-light">
                                    <p class="font-weight-bold m-0">Berakhir pada</p>
                                </div>
                                <div class="col-12 col-sm-12 col-md-8 col-lg-9 p-2 border border-1">
                                    <p class="m-0">
                                        {{ $user->paket_membership && $user->paket_membership->expired_at ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->paket_membership->expired_at)->translatedFormat('H:i, d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 text-primary"><strong>Bisnis</strong></h6>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Bisnis</th>
                                        <th>Bidang</th>
                                        <th>Industri</th>
                                        <th style="min-width:30px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($user->bisnis && count($user->bisnis) > 0)
                                        @foreach ($user->bisnis as $key => $bisnis)
                                            <tr>
                                                <td>{{ $bisnis->id_userpreneur }}</td>
                                                <td>
                                                    {{ $bisnis->nama_bisnis }}
                                                </td>
                                                <td> {{ $bisnis->bidang_usaha }}</td>
                                                <td> {{ $bisnis->industri }}</td>
                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>
                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item'
                                                                href="/admin/bisnis/{{ $bisnis->id_userpreneur }}">Detail</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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
