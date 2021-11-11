@extends('admin.layout.container')
@section('title')
    Member - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Member</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid teks12">
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-9 col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Semua Member</h6>
                    </div>
                    <div class="card-body">
                        <a class='btn btn-primary' href='/admin/member/tambah'>Tambah</a>
                        <br><br>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' id='dataTable'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Foto</th>
                                        <th style="min-width:150px">Nama</th>
                                        <th style="min-width:300px">Alamat</th>
                                        <th style="min-width:200px">E-Mail</th>
                                        <th>Telepon</th>
                                        <th style="min-width:200px">Jenis Membership</th>
                                        <th style="min-width:200px">Akun Bisnis</th>
                                        <th style="min-width:150px">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @if ($member && count($member) > 0)
                                    @foreach ($member as $key => $members)
                                        <tbody>
                                            <tr>
                                                <td>{{ $members->id_user }}</td>
                                                <td>
                                                    <img class='rounded-circle'
                                                        src="{{ !$members->foto || $members->foto == 'Kosong' ? '/assets/img/nofoto.png' : '/uploads/photo/' . $members->foto }}"
                                                        width='50' height='50' />
                                                </td>
                                                <td>
                                                    {{ $members->nama_user }}
                                                </td>
                                                <td>{{ $members->alamat }}</td>
                                                <td>{{ $members->email }}</td>
                                                <td>{{ $members->no_hp }}</td>
                                                <td>
                                                    @if ($members && $members->paket_membership && $members->paket_membership->paket)
                                                        <a
                                                            href="/admin/paket/{{ $members->paket_membership->paket->id_paket }}">{{ $members->paket_membership->paket->nama_paket }}</a>
                                                    @else
                                                        Tidak ada
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($members->bisnis && count($members->bisnis) > 0)
                                                        @foreach ($members->bisnis as $bisnis)
                                                            <div><a
                                                                    href="/admin/bisnis/{{ $bisnis->id_userpreneur }}">{{ $bisnis->nama_bisnis }}</a>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        Belum ada
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($members->status == 'Aktif')
                                                        <span class="badge badge-success">{{ $members->status }}</span>
                                                    @elseif($members->status == 'Deactive')
                                                        <span class="badge badge-danger">{{ $members->status }}</span>
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
                                                                href='/admin/member/{{ $members->id_user }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/member/edit/{{ $members->id_user }}'>Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="10">Tidak ada member</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $member->links() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Member Keseluruhan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h4 class="font-weight-bold"><i class='fa fa-users ' aria-hidden='true'></i>
                            {{ $memberCount }}
                            Member</h4>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Member Per Paket</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @foreach ($paketMember as $index => $paket)
                            <a href='/admin/member?type={{ $paket->slug }}'
                                class='media mb-2 py-2 border border-1 text-decoration-none rounded'>
                                <img src='/assets/foto/paket/{{ $paket->foto_paket }}' width='100px'
                                    class="align-self-center" />
                                <div class="media-body font-">
                                    <h6 class="mb-0"><strong>{{ $paket->nama_paket }}</strong></h6>
                                    <small class="text-muted">
                                        @if ($paket->memberCount > 0)
                                            {{ $paket->memberCount }} Member.
                                        @else
                                            Tidak ada member
                                        @endif
                                    </small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
