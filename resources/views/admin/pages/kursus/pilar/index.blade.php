@extends('admin.layout.container')

@section('title')
    Pilar - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pilar</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Data Semua Pilar</h6>
                    </div>

                    <div class="card-body">

                        <a class='btn btn-primary' href='/admin/pilar/tambah'>Tambah</a>
                        <br><br>

                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pilar</th>
                                        <th>Kelas</th>
                                        <th>Jumlah Pelajaran</th>
                                        <th>Kondisi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pilar && count($pilar) > 0)
                                        @foreach ($pilar as $key => $pilars)
                                            <tr>
                                                <td>{{ $pilars->order_id }}</td>
                                                <td>

                                                    {{ $pilars->nama_pilar }}
                                                </td>

                                                <td>
                                                    @if ($pilars->kelas)
                                                        <a href="/admin/kelas/{{ $pilars->kelas->id_kelas }}">{{ $pilars->kelas->nama_kelas }}
                                                        </a>
                                                    @else
                                                        Belum ada
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($pilars->kursus && count($pilars->kursus) > 0)
                                                        {{ count($pilars->kursus) }} Pelajaran
                                                    @else
                                                        Belum ada
                                                    @endif
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge {{ $pilars->kondisi == 'DRAFT' ? 'badge-secondary' : 'badge-primary' }}">{{ $pilars->kondisi }}</span>
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
                                                                href='/admin/pilar/{{ $pilars->id_pilar }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/pilar/edit/{{ $pilars->id_pilar }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/pilar/delete/{{ $pilars->id_pilar }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="6">Tidak ada data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $pilar->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
