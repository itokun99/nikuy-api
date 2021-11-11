@extends('admin.layout.container')

@section('title')
    Metode Pembayaran - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Metode Pembayaran</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Metode Pembayaran</h6>
                    </div>

                    <div class="card-body">

                        <div class="mb-4">
                            <a class='btn btn-primary' href='/admin/metode-pembayaran/tambah/'>Tambah</a>
                        </div>

                        <div class='table-responsive table-hover'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th style="min-width:50px">Logo</th>
                                        <th style="min-width:150px">Bank</th>
                                        <th style="min-width:150px">Rekening</th>
                                        <th style="min-width:150px">Pemilik</th>
                                        <th style="min-width:150px">Tipe</th>
                                        <th style="min-width:150px">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($payments && count($payments) > 0)
                                        @foreach ($payments as $key => $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>
                                                    @if ($payment->bank && $payment->bank->logo)
                                                        <a href='/assets/foto/img/{{ $payment->bank->logo }}'>
                                                            <img src='/assets/foto/img/{{ $payment->bank->logo }}'
                                                                width='75' />
                                                        </a>
                                                    @else
                                                        <img src='/assets/img/nofoto.png' width='75' />
                                                    @endif
                                                </td>
                                                <td>{{ $payment->bank ? $payment->bank->nama : '-' }}</td>
                                                <td>{{ $payment->rekening }}</td>
                                                <td>{{ $payment->pemilik }}</td>
                                                <td>{{ $payment->tipe }}</td>
                                                <td class="text-center"><span
                                                        class="badge {{ $payment->status == 'Aktif' ? 'badge-primary' : 'badge-secondary' }}">{{ $payment->status }}</span>
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
                                                                href='/admin/metode-pembayaran/{{ $payment->id }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/metode-pembayaran/edit/{{ $payment->id }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/metode-pembayaran/delete/{{ $payment->id }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="7">
                                                Tidak ada
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            {!! $payments->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
