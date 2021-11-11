@extends('admin.layout.container')

@section('title')
    Transaksi - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="keterangan">
                                                <option value="">Semua Transaksi</option>
                                                <option value="Menunggu" @if (request()->get('keterangan') == 'Menunggu') selected @endif>Belum Diproses</option>
                                                <option value="Ok" @if (request()->get('keterangan') == 'Ok') selected @endif>Sudah Diproses</option>
                                                <option value="Ditolak" @if (request()->get('keterangan') == 'Ditolak') selected @endif>Ditolak</option>
                                                <option value="Expired" @if (request()->get('keterangan') == 'Expired') selected @endif>Expired</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' width='100%'>
                                <thead class='bg-dark text-white'>
                                    <tr>
                                        <th>ID</th>
                                        <th style="min-width:200px">Nama Transaksi</th>
                                        <th style="min-width:200px">Bukti Pembayaran</th>
                                        <th style="min-width:200px">Biaya Transaksi</th>
                                        <th style="min-width:250px">Bank Asal</th>
                                        <th style="min-width:250px">No. Rekening</th>
                                        <th style="min-width:250px">Pemilik Rekening</th>
                                        <th style="min-width:250px">Member</th>
                                        <th style="min-width:250px">Item</th>
                                        <th style="min-width:250px">Tanggal Transaksi</th>
                                        <th style="min-width:250px">Tanggal Berakhir</th>
                                        <th style="min-width:100px">Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($transaksi && count($transaksi) > 0)
                                        @foreach ($transaksi as $key => $transaksiis)
                                            <tr>
                                                <td>{{ $transaksiis->id_transaksi }}</td>
                                                <td>
                                                    {{ $transaksiis->nama_transaksi }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($transaksiis->foto_struk)
                                                        <a href='/assets/foto/struk/{{ $transaksiis->foto_struk }}'>
                                                            <img src='/assets/foto/struk/{{ $transaksiis->foto_struk }}'
                                                                width='50' height='50' />
                                                        </a>
                                                    @else
                                                        Tidak ada
                                                    @endif

                                                </td>
                                                <td class="text-right">Rp.
                                                    {{ number_format($transaksiis->biaya_transaksi, 2, ',', '.') }}
                                                </td>
                                                <td>{{ $transaksiis->bank_asal }}</td>
                                                <td>
                                                    {{ $transaksiis->no_rek }}
                                                </td>
                                                <td> {{ $transaksiis->nama_rekening }}</td>
                                                <td>
                                                    @if ($transaksiis->user)
                                                        <a href="/admin/member/{{ $transaksiis->user->id_user }}">
                                                            {{ $transaksiis->user->nama_user }}
                                                        </a>
                                                    @else
                                                        Tidak ada
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($transaksiis->paket)
                                                        <a
                                                            href="/admin/paket/{{ $transaksiis->paket->id_paket }}">{{ $transaksiis->paket->nama_paket }}</a>
                                                    @endif

                                                    @if ($transaksiis->event)
                                                        <a
                                                            href="/admin/event/{{ $transaksiis->event->id_event }}">{{ $transaksiis->event->nama_event }}</a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $transaksiis->tgl_transaksi ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $transaksiis->tgl_transaksi)->translatedFormat('d F Y') : '-' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $transaksiis->tgl_berakhir ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $transaksiis->tgl_berakhir)->translatedFormat('d F Y') : '-' }}

                                                </td>
                                                <td class="text-center">
                                                    @if ($transaksiis->keterangan == 'Ok')
                                                        <span
                                                            class='badge badge-success'>{{ $transaksiis->keterangan }}</span>
                                                    @elseif ($transaksiis->keterangan == 'Expired')
                                                        <span
                                                            class='badge badge-danger'>{{ $transaksiis->keterangan }}</span>
                                                    @elseif ($transaksiis->keterangan == 'Menunggu')
                                                        <span
                                                            class='badge badge-info'>{{ $transaksiis->keterangan }}</span>
                                                    @elseif ($transaksiis->keterangan == 'Ditolak')
                                                        <span
                                                            class='badge badge-warning'>{{ $transaksiis->keterangan }}</span>
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
                                                            <a class='dropdown-item'
                                                                href='/admin/transaksi/{{ $transaksiis->id_transaksi }}'>Detail</a>

                                                            @if ($transaksiis->keterangan == 'Menunggu')
                                                                <a class='dropdown-item' href='#' data-toggle='modal'
                                                                    data-target='#modal-konfirmasi-transaksi-{{ $transaksiis->id_transaksi }}'>Terima</a>
                                                                <a class='dropdown-item' href='#' data-toggle="modal"
                                                                    data-target="#modal-tolak-transaksi-{{ $transaksiis->id_transaksi }}">Tolak</a>
                                                            @endif


                                                            @if (Auth::user()->hak_akses == 'Super Admin' && ($transaksiis->keterangan == 'Expired' || $transaksiis->keterangan == 'Ditolak' || $transaksiis->keterangan == 'Ok'))
                                                                <a class='dropdown-item' href='#' data-toggle="modal"
                                                                    data-target="#modal-delete-transaksi-{{ $transaksiis->id_transaksi }}">Hapus</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class='modal fade'
                                                id='modal-konfirmasi-transaksi-{{ $transaksiis->id_transaksi }}'
                                                tabindex='-1' role='dialog' aria-labelledby='modelTitleId'
                                                data-backdrop="static" aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <form
                                                            action='/admin/transaksi/konfirmasi/{{ $transaksiis->id_transaksi }}'
                                                            method='post'>
                                                            @csrf
                                                            <div class='modal-header'>
                                                                <h5 class="modal-title">Konfirmasi</h5>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div>Apakah anda yakin ingin menerima proses transaksi
                                                                    <strong>{{ $transaksiis->id_transaksi }}</strong>?
                                                                    status transaksi akan berubah menjadi
                                                                    <strong>"Ok"</strong>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Terima</button>
                                                                <button type="submit" class="btn btn-secondary"
                                                                    data-dismiss="modal">Kembali</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class='modal fade'
                                                id='modal-tolak-transaksi-{{ $transaksiis->id_transaksi }}' tabindex='-1'
                                                role='dialog' aria-labelledby='modelTitleId' data-backdrop="static"
                                                aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <form
                                                            action='/admin/transaksi/tolak/{{ $transaksiis->id_transaksi }}'
                                                            method='post'>
                                                            @csrf
                                                            <div class='modal-header'>
                                                                <h5 class="modal-title">Konfirmasi</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">Apakah anda yakin ingin
                                                                    menolak
                                                                    proses transaksi
                                                                    <strong>{{ $transaksiis->id_transaksi }}</strong>?
                                                                    status transaksi akan berubah menjadi
                                                                    <strong>"Ditolak"</strong>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="">Pesan
                                                                        Penolakan</label>
                                                                    <textarea class="form-control" name="pesan"
                                                                        required></textarea>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                                                <button type="submit" class="btn btn-secondary"
                                                                    data-dismiss="modal">Kembali</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class='modal fade'
                                                id='modal-delete-transaksi-{{ $transaksiis->id_transaksi }}'
                                                tabindex='-1' role='dialog' aria-labelledby='modelTitleId'
                                                data-backdrop="static" aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <form
                                                            action='/admin/transaksi/delete/{{ $transaksiis->id_transaksi }}'
                                                            method='post'>
                                                            @csrf
                                                            <div class='modal-header'>
                                                                <h5 class="modal-title">Konfirmasi</h5>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div class="mb-3">Apakah anda yakin ingin
                                                                    menghapus transaksi
                                                                    <strong>{{ $transaksiis->id_transaksi }}</strong> }?
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                                <button type="submit" class="btn btn-secondary"
                                                                    data-dismiss="modal">Kembali</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="13">Tidak ada transaksi</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $transaksi->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
