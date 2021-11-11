@extends('admin.layout.container')

@section('title')
    Bisnis Member - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bisnis</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Data Bisnis Member</h6>
                    </div>

                    <div class="card-body">
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Bisnis</th>
                                        <th>Bidang</th>
                                        <th>Industri</th>
                                        <th style="min-width:30px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($userbisnis && count($userbisnis) > 0)
                                        @foreach ($userbisnis as $key => $userbisniss)
                                            <tr>
                                                <td>{{ $userbisniss->id_userpreneur }}</td>
                                                <td>
                                                    {{ $userbisniss->nama_bisnis }}
                                                </td>
                                                <td> {{ $userbisniss->bidang_usaha }}</td>
                                                <td> {{ $userbisniss->industri }}</td>
                                                <td class="text-right">
                                                    <div class='btn-group' role='group'>
                                                        <button id='aksi' type='button'
                                                            class='btn btn-secondary btn-sm dropdown-toggle'
                                                            data-toggle='dropdown' aria-haspopup='true'
                                                            aria-expanded='false'>
                                                        </button>
                                                        <div class='dropdown-menu' aria-labelledby='aksi'>
                                                            <a class='dropdown-item'
                                                                href="/admin/bisnis/{{ $userbisniss->id_userpreneur }}">Detail</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">Tidak ada</td>
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
