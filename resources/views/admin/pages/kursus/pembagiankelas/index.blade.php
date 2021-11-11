@extends('admin.layout.container')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pembagian Kelas</li>
        </ol>
    </nav>
@stop

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-9 col-lg-8">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Kelas per Paket</h6>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a class='btn btn-primary' href='/admin/pembagian-kelas/tambah'>Tambah</a>
                        </div>

                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Paket</th>
                                        <th>Nama Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($paketkelass && count($paketkelass) > 0)
                                        @foreach ($paketkelass as $key => $paketkelasss)

                                            <tr>
                                                <td>{{ $paketkelasss->id_paketkelas }}</td>
                                                <td>
                                                    <a href="/admin/paket/{{ $paketkelasss->paket->id_paket }}">
                                                        {{ $paketkelasss->paket->nama_paket }}
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href="/admin/kelas/{{ $paketkelasss->kelas->id_kelas }}">
                                                        {{ $paketkelasss->kelas->nama_kelas }}
                                                    </a>
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
                                                                href='/admin/pembagian-kelas/edit/{{ $paketkelasss->id_paketkelas }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/pembagian-kelas/delete/{{ $paketkelasss->id_paketkelas }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">Tidak ada data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>

            <div class="col-xl-3 col-lg-4">

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kelas Per Paket</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        @foreach ($paket_member as $paket)
                            <a href='/admin/paket/{{ $paket->id_paket }}'
                                class='media mb-2 py-2 border border-1 text-decoration-none rounded'>
                                <img src='/assets/foto/paket/{{ $paket->foto_paket }}' width='100px'
                                    class="align-self-center" />
                                <div class="media-body font-">
                                    <h6 class="mb-0"><strong>{{ $paket->nama_paket }}</strong></h6>
                                    <small class="text-muted">
                                        @if ($paket->paket_kelas && count($paket->paket_kelas) > 0)
                                            {{ count($paket->paket_kelas) }} Kelas
                                        @else
                                            Tidak ada kelas
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
