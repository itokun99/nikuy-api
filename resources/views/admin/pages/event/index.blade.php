@extends('admin.layout.container')

@section('title')
    Event - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Event</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">List Event</h6>
                    </div>

                    <div class="card-body">

                        <a class='btn btn-primary' href='/admin/event/tambah/'>Tambah</a>
                        <br><br>

                        <div class='table-responsive table-hover'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th style="min-width:50px">Foto</th>
                                        <th style="min-width:250px">Nama Event</th>
                                        <th style="min-width:200px">Peserta (Jumlah/Kuota)</th>
                                        <th style="min-width:250px">Waktu</th>
                                        <th style="min-width:300px">Lokasi</th>
                                        <th style="min-width:300px">Venue</th>
                                        <th style="min-width:200px">Harga</th>
                                        <th style="min-width:200px">Harga Diskon</th>
                                        <th style="min-width:150px">Kondisi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($events && count($events) > 0)
                                        @foreach ($events as $key => $eventss)
                                            <tr>
                                                <td>{{ $eventss->id_event }}</td>
                                                <td>
                                                    <a href='/assets/foto/event/{{ $eventss->foto_event }}'>
                                                        <img src='/assets/foto/event/{{ $eventss->foto_event }}'
                                                            width='50' />
                                                    </a>

                                                </td>
                                                <td>{{ $eventss->nama_event }}</td>
                                                <td class="text-center">
                                                    0/{{ $eventss->kuota }}
                                                </td>
                                                <td>
                                                    {{ $eventss->waktu ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $eventss->waktu)->translatedFormat('H:i, d F Y') : 'Belum ada' }}
                                                </td>
                                                <td>{{ $eventss->lokasi }}</td>
                                                <td>{{ $eventss->venue }}</td>
                                                <td class="text-right">
                                                    @if ($eventss->harga_event > 0)
                                                        Rp.
                                                        {{ number_format($eventss->harga_event, 0, ',', '.') }}
                                                    @elseif (!is_null($eventss->harga_event) &&
                                                        $eventss->harga_event== 0)
                                                        Free
                                                    @else

                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if ($eventss->harga_diskon > 0)
                                                        Rp.
                                                        {{ number_format($eventss->harga_diskon, 0, ',', '.') }}
                                                    @elseif (!is_null($eventss->harga_diskon) &&
                                                        $eventss->harga_diskon== 0)
                                                        Free
                                                    @else
                                                        Tanpa diskon
                                                    @endif
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge {{ $eventss->kondisi == 'DRAFT' ? 'badge-secondary' : 'badge-primary' }}">{{ $eventss->kondisi }}</span>
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
                                                                href='/admin/event/{{ $eventss->id_event }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/event/edit/{{ $eventss->id_event }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/event/delete/{{ $eventss->id_event }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="10">
                                                Tidak ada
                                            </td>
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
