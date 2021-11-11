@extends('admin.layout.container')

@section('title')
    Kelas - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kelas</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
                    </div>

                    <div class="card-body">

                        <a class='btn btn-primary' href='/admin/kelas/tambah'>Tambah</a>
                        <br><br>

                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th style="min-width:50px">No</th>
                                        <th style="min-width:100px">Thumbnail</th>
                                        <th style="min-width:200px">Nama Kelas</th>
                                        <th>Jumlah Pelajaran</th>
                                        <th style="min-width:50px">Kondisi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($kelass && count($kelass) > 0)
                                        @foreach ($kelass as $key => $kelasss)
                                            <tr>
                                                <td>{{ $kelasss->order_id }}</td>
                                                <td>
                                                    <img src='/assets/foto/kelas/{{ $kelasss->foto_kelas }}' width='100'>
                                                </td>
                                                <td>
                                                    {{ $kelasss->nama_kelas }}
                                                </td>

                                                <td>
                                                    @if ($kelasss->kursus && count($kelasss->kursus) > 0)
                                                        {{ count($kelasss->kursus) }} Pelajaran
                                                    @else
                                                        Tidak ada pelajaran
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <span
                                                        class="badge {{ $kelasss->kondisi == 'DRAFT' ? 'badge-secondary' : 'badge-primary' }}">{{ $kelasss->kondisi }}</span>
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
                                                                href='/admin/kelas/{{ $kelasss->id_kelas }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/kelas/edit/{{ $kelasss->id_kelas }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/kelas/delete/{{ $kelasss->id_kelas }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">Tidak ada kelas</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $kelass->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
