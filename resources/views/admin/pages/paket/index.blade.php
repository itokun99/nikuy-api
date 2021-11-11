@extends('admin.layout.container')
@section('title')
    Paket Membership - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Paket Membership</li>
        </ol>
    </nav>
@stop

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Semua Paket</h6>
                    </div>

                    <div class="card-body">
                        <a class='btn btn-primary' href='/admin/paket/tambah'>Tambah</a>
                        <br><br>

                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Thumbnail</th>
                                        <th style="min-width:200px">Nama Paket</th>
                                        <th style="min-width:200px">Harga</th>
                                        <th style="min-width:150px">Jumlah Kelas</th>
                                        <th style="min-width:150px">Member Terdaftar</th>
                                        <th>Kondisi</th>
                                        <th style="min-width:100px">Masa Berlaku</th>
                                        <th style="min-width:100px">Urutan</th>
                                        <th style="min-width:100px">Default Paket</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($paketmember && count($paketmember) > 0)
                                        @foreach ($paketmember as $key => $paketmembers)
                                            <tr>
                                                <td>{{ $paketmembers->id_paket }}</td>

                                                <td class="text-center">
                                                    <img src='/assets/foto/paket/{{ $paketmembers->foto_paket }}'
                                                        width='100'>
                                                </td>
                                                <td>{{ $paketmembers->nama_paket }}</td>
                                                <td class="text-right">Rp.
                                                    {{ number_format($paketmembers->harga_member, 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    @if ($paketmembers && $paketmembers->paket_kelas && count($paketmembers->paket_kelas) > 0)
                                                        {{ count($paketmembers->paket_kelas) }} Kelas
                                                    @else
                                                        Belum ada kelas
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($paketmembers->members && count($paketmembers->members) > 0)
                                                        {{ count($paketmembers->members) }} Orang
                                                    @else
                                                        <span>Tidak ada<span>
                                                    @endif
                                                </td>
                                                <td><span
                                                        class='badge {{ $paketmembers->kondisi == 'DRAFT' ? 'badge-secondary' : 'badge-primary' }}'>{{ $paketmembers->kondisi }}</span>
                                                </td>
                                                <td>{{ $paketmembers->masa_berlaku }}</td>
                                                <td>{{ $paketmembers->order }}</td>
                                                <td>{{ $paketmembers->default == 1 ? 'Ya' : 'Tidak' }}</td>

                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>

                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item'
                                                                href='/admin/paket/{{ $paketmembers->id_paket }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/paket/edit/{{ $paketmembers->id_paket }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/paket/delete/{{ $paketmembers->id_paket }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="9">Tidak ada data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $paketmember->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
