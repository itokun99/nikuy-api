@extends('admin.layout.container')

@section('title')
    Profil - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profil</li>
        </ol>
    </nav>
@stop

@section('content')

    <form action="/admin/profile" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Begin Page Content -->
        <div class="container-fluid">


            <!-- Content Row -->
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" type="text" name="nama" value="{{ $user->nama_user ?? '' }}"
                                    placeholder="Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea id="my-textarea" class="form-control" name="alamat" placeholder="Alamat"
                                    rows="3">{{ $user->alamat ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" name="provinsi">
                                    <option value="">Pilih Provinsi</option>
                                    @if ($provinsi)
                                        @foreach ($provinsi as $prov))
                                            <option value="{{ $prov->id_provinsi }}" @if ($user && $prov->id_provinsi == $user->provinsi) selected @endif>
                                                {{ $prov->nama_provinsi }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input class="form-control" type="date" name="tglahir"
                                    value="{{ $user->tgl_lahir ?? '' }}" placeholder="Tgl Lahir">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input name="jekel" class="form-check-input" type="radio" id="inlineCheckbox1"
                                            value="Laki-laki" @if ($user && $user->jenis_kelamin == 'Laki-laki') checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="jekel" class="form-check-input" type="radio" id="inlineCheckbox2"
                                            value="Perempuan" @if ($user && $user->jenis_kelamin == 'Perempuan') checked @endif>
                                        <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nomor Handphone</label>
                                <input class="form-control" type="number" name="nohp" value="{{ $user->no_hp ?? '' }}"
                                    placeholder="No. Handphone">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" value="{{ $user->email ?? '' }}"
                                    placeholder="example@mail.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">
                                {{ $user && $user->id_user ? 'Ubah Kata Sandi' : 'Atur Kata Sandi' }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Kata sandi baru</label>
                                <input class="form-control" type="password" name="password" value="" placeholder=""
                                    autocomplete="new-password" @if (!$user) required @endif autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi kata sandi baru</label>
                                <input class="form-control" type="password" name="password_confirmation" value=""
                                    placeholder="" autocomplete="new-password" @if (!$user) required @endif autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
                        </div>
                        <div class="card-body">
                            <div id="input-upload" name="foto" label="Upload Foto"
                                image="{{ $user && $user->foto ? '/uploads/photo/' . $user->foto : '/assets/img/nofoto.png' }}">
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Status</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select disabled class="form-control" name="status" required>
                                    <option value="Aktif" @if ($user && $user->status == 'Aktif') selected @endif>
                                        Aktif
                                    </option>
                                    <option value="Deactive" @if ($user && $user->status == 'Deactive') selected @endif>
                                        Deactive
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Hak Akses</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select disabled class="form-control" name="hak_akses" required>
                                    <option value="Administrator" @if ($user && $user->hak_akses == 'Administrator') selected @endif>
                                        Administrator
                                    </option>
                                    @if (Auth::user()->hak_akses == 'Super Admin')
                                        <option value="Super Admin" @if ($user && $user->hak_akses == 'Super Admin') selected @endif>
                                            Super Admin
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <input type="submit" value="Simpan" class="btn btn-primary mr-2">
                        </div>
                    </div>
                </div>
            </div>
    </form>
@stop


@push('custom-js')
    @include('admin.component.input-upload')
@endpush
