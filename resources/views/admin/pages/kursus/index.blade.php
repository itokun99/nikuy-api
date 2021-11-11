@extends('admin.layout.container')

@section('title')
    Kursus - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kursus</li>
        </ol>
    </nav>
@stop

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Kursus</h6>
                    </div>

                    <div class="card-body">
                        <a class='btn btn-primary mb-4' href='/admin/kursus/tambah'>Tambah</a>

                        <div class='table-responsive'>
                            <table class='table table-bordered  table-hover'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>No</th>
                                        <th>Thumbnail</th>
                                        <th style="min-width:200px">Nama Kursus</th>
                                        <th style="min-width:160px">Nama Paket</th>
                                        <th style="min-width:200px">Kelas</th>
                                        <th style="min-width:250px">Pilar</th>
                                        <th>Kondisi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($kursuss && count($kursuss) > 0)
                                        @foreach ($kursuss as $key => $kursusss)
                                            <tr>
                                                <td>{{ $kursusss->order_id }}</td>
                                                <td>
                                                    @if ($kursusss->foto_kursus && $kursusss->foto_kursus != 'Kosong')
                                                        <img src='/assets/foto/kursus/{{ $kursusss->foto_kursus }}'
                                                            width='100' />
                                                    @else
                                                        <img src='/assets/img/nofoto.png' width='100' />
                                                    @endif

                                                </td>
                                                <td> {{ $kursusss->nama_kursus }}</td>
                                                <td>
                                                    <a
                                                        href="/admin/paket/{{ $kursusss->paket->id_paket }}">{{ $kursusss->paket->nama_paket }}</a>
                                                </td>
                                                <td><a
                                                        href="/admin/kelas/{{ $kursusss->kelas->id_kelas }}">{{ $kursusss->kelas->nama_kelas }}</a>
                                                </td>
                                                <td>
                                                    <a
                                                        href="/admin/pilar/{{ $kursusss->pilar->id_pilar }}">{{ $kursusss->pilar->nama_pilar }}</a>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge {{ $kursusss->kondisi == 'DRAFT' ? 'badge-secondary' : 'badge-primary' }}">{{ $kursusss->kondisi }}</span>
                                                </td>
                                                <td>
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>

                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item modal-view'
                                                                href='/admin/kursus/{{ $kursusss->id_kursus }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/kursus/edit/{{ $kursusss->id_kursus }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/kursus/delete/{{ $kursusss->id_kursus }}'>Hapus</a>
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
                        <div class="d-flex justify-content-end">
                            {!! $kursuss->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
