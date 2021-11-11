@extends('admin.layout.container')

@section('title')
    File Kursus - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">File Kursus</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Data File Kursus</h6>
                    </div>

                    <div class="card-body">
                        <a class='btn btn-primary mb-4' href='/admin/file-kursus/tambah'>Tambah</a>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>File</th>
                                        <th>Paket</th>
                                        <th>Kelas</th>
                                        <th>Pilar</th>
                                        <th>Kondisi</th>
                                        <th style="min-width:50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($kursuss && count($kursuss) > 0)
                                        @foreach ($kursuss as $key => $kursusss)
                                            <tr>
                                                <td>{{ $kursusss->id_kursus }}</td>
                                                <td>{{ $kursusss->nama_kursus }}</td>
                                                <td>
                                                    <a
                                                        href="/admin/file-kursus/download/{{ $kursusss->id_kursus }}">{{ $kursusss->file_kursus }}</a>
                                                </td>
                                                <td>
                                                    @if ($kursusss->paket)
                                                        <a
                                                            href="/admin/paket/{{ $kursusss->paket->id_paket }}">{{ $kursusss->paket->nama_paket }}</a>
                                                    @else
                                                        Tidak ada
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($kursusss->kelas)
                                                        <a
                                                            href="/admin/kelas/{{ $kursusss->kelas->id_kelas }}">{{ $kursusss->kelas->nama_kelas }}</a>
                                                    @else
                                                        Tidak ada
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($kursusss->pilar)
                                                        <a
                                                            href="/admin/pilar/{{ $kursusss->pilar->id }}">{{ $kursusss->pilar->nama_pilar }}</a>
                                                    @else
                                                        Tidak ada
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge {{ $kursusss->kondisi == 'DRAFT' ? 'badge-secondary' : 'badge-primary' }}">{{ $kursusss->kondisi }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>

                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item'
                                                                href='/admin/file-kursus/edit/{{ $kursusss->id_kursus }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/file-kursus/delete/{{ $kursusss->id_kursus }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="8">Tidak ada</td>
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
