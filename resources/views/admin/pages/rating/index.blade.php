@extends('admin.layout.container')

@section('title')
    Rating - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rating</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">List Rating</h6>
                    </div>

                    <div class="card-body">
                        <div class='table-responsive table-hover'>
                            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Member</th>
                                        <th>Kelas</th>
                                        <th>Rating</th>
                                        <th>Komentar</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($ratingkelas && count($ratingkelas) > 0)
                                        @foreach ($ratingkelas as $key => $ratingkelass)
                                            <tr>
                                                <td>{{ $ratingkelass->id_rating }}</td>
                                                <td>
                                                    <a
                                                        href="/admin/member/{{ $ratingkelass->user->id_user ?? '' }}">{{ $ratingkelass->user->nama_user ?? '' }}</a>
                                                </td>
                                                <td>
                                                    <a
                                                        href="/admin/kelas/{{ $ratingkelass->kelas->id_kelas ?? '' }}">{{ $ratingkelass->kelas->nama_kelas }}</a>
                                                </td>
                                                <td class="text-center">
                                                    {{ $ratingkelass->level_rating }}
                                                </td>
                                                <td>
                                                    {{ $ratingkelass->komentar }}
                                                </td>
                                                <td class="text-center">
                                                    {{ date('d F Y', strtotime($ratingkelass->tgl_komen)) }}
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class='badge badge-warning'>{{ $ratingkelass->ket_rating }}</span>
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
                                                                href='/admin/rating/{{ $ratingkelass->id_rating }}'>Detail</a>
                                                            <a class='dropdown-item'
                                                                href='/admin/rating/delete/{{ $ratingkelass->id_rating }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada</td>
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
