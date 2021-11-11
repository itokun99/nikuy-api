@extends('admin.layout.container')

@section('title')
    Banner - ELITES Admin
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Banner</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Banner Homepage</h6>
                    </div>
                    <div class="card-body">
                        <a class='btn btn-primary mb-4' href='#' data-toggle='modal' data-target='#addHomeBanner'>Tambah</a>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Gambar</th>
                                        <th>Teks Alternatif</th>
                                        <th style="min-width:200px">Link</th>
                                        <th style="min-width:50px">Urutan</th>
                                        <th>Kondisi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($slider && count($slider) > 0)
                                        @foreach ($slider as $key => $slider)
                                            <tr>
                                                <td>{{ $slider->id_slider }}</td>
                                                <td>
                                                    <a href='/assets/foto/slider/{{ $slider->foto_slider }}'>
                                                        <img alt="{{ $slider->alt }}"
                                                            src='/assets/foto/slider/{{ $slider->foto_slider }}'
                                                            width='100' />
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $slider->alt }}
                                                </td>
                                                <td>
                                                    @if ($slider->link)
                                                        <a href="{{ $slider->link }}"
                                                            target="_blank">{{ $slider->link }}</a>
                                                    @else
                                                        Tidak ada
                                                    @endif
                                                </td>

                                                <td class="text-center">{{ $slider->order }}</td>

                                                <td class="text-center">
                                                    @if ($slider->kondisi == 'POSTING')
                                                        <span class="badge badge-primary">{{ $slider->kondisi }}</span>
                                                    @elseif($slider->kondisi == 'DRAFT')
                                                        <span class="badge badge-secondary">{{ $slider->kondisi }}</span>
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
                                                            <a class='dropdown-item' href='#' data-toggle='modal'
                                                                data-target='#editHomeBanner{{ $slider->id_slider }}'>Edit</a>
                                                            <a class='dropdown-item'
                                                                href="/admin/banner/delete/{{ $slider->id_slider }}">Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class='modal fade' id='editHomeBanner{{ $slider->id_slider }}'
                                                tabindex='-1' role='dialog' aria-labelledby='modelTitleId'
                                                aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title'>Edit Banner</h5>
                                                            <button type='button' class='close' data-dismiss='modal'
                                                                aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <form action="/admin/banner/edit/{{ $slider->id_slider }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Gambar</label>
                                                                    <div class="input-upload" name="foto_slider"
                                                                        label="Upload Gambar"
                                                                        image="{{ $slider && $slider->foto_slider ? '/assets/foto/slider/' . $slider->foto_slider : '/assets/img/nofoto.png' }}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Teks
                                                                        Alternatif</label>
                                                                    <input type="text" class="form-control" name="alt"
                                                                        placeholder="Teks alternatif" required
                                                                        value="{{ $slider->alt }}" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Link</label>
                                                                    <input type="text" class="form-control" name="link"
                                                                        placeholder="Link" value="{{ $slider->link }}" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Urutan</label>
                                                                    <input type="number" class="form-control" name="order"
                                                                        placeholder="0" value="{{ $slider->order }}" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="" class="form-label">Kondisi</label>
                                                                    <select class="form-control" name="kondisi" required>
                                                                        <option value="POSTING"
                                                                            {{ $slider->kondisi == 'POSTING' ? 'selected' : '' }}>
                                                                            Posting</option>
                                                                        <option value="DRAFT"
                                                                            {{ $slider->kondisi == 'DRAFT' ? 'selected' : '' }}>
                                                                            Draft</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="7">Tidak ada</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Banner Kelas</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <a class='btn btn-primary' href='#' data-toggle='modal' data-target='#addBannerKelas'>Tambah</a>
                        </div>
                        <div class='table-responsive'>
                            <table class='table table-bordered table-hover' id='dataTable' width='100%' cellspacing='0'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Kelas</th>
                                        <th>Urutan</th>
                                        <th>Kondisi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($bannerKelas && count($bannerKelas) > 0)
                                        @foreach ($bannerKelas as $key => $banner)
                                            <tr>
                                                <td>{{ $banner->id }}</td>
                                                <td>
                                                    <a href='/assets/foto/slider/{{ $banner->gambar }}'>
                                                        <img alt="{{ $banner->alt }}"
                                                            src='/assets/foto/slider/{{ $banner->gambar }}' width='50' />
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $banner->judul }}
                                                </td>
                                                <td>
                                                    @if ($banner->kelas)
                                                        <a
                                                            href="/admin/kelas/{{ $banner->kelas->id_kelas }}">{{ $banner->kelas->nama_kelas }}</a>
                                                    @else
                                                        Tidak ada
                                                    @endif
                                                </td>

                                                <td class="text-center">{{ $banner->order }}</td>

                                                <td class="text-center">
                                                    @if ($banner->kondisi == 'POSTING')
                                                        <span class="badge badge-primary">{{ $banner->kondisi }}</span>
                                                    @elseif($banner->kondisi == 'DRAFT')
                                                        <span class="badge badge-secondary">{{ $banner->kondisi }}</span>
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
                                                                href='/admin/banner-kelas/edit/{{ $banner->id }}'>Edit</a>
                                                            <a class='dropdown-item' href='#' data-toggle='modal'
                                                                data-target='#konfirmasiHapusBannerKelas-{{ $banner->id }}'>Hapus</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <div class='modal fade' id='konfirmasiHapusBannerKelas-{{ $banner->id }}'
                                                tabindex='-1' role='dialog' aria-labelledby='modelTitleId'
                                                aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <form action="/admin/banner-kelas/delete/{{ $banner->id }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title'>Konfirmasi</h5>
                                                                <button type='button' class='close' data-dismiss='modal'
                                                                    aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body'>

                                                                <div>Apakah yakin ingin menghapus banner
                                                                    <strong>{{ $banner->judul }}</strong>?
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss='modal' aria-label='Close'>Kembali</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="7">Tidak ada</td>
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

    <div class='modal fade' id='addHomeBanner' tabindex='-1' role='dialog' aria-labelledby='modelTitleId'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Tambah Banner</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <form action="/admin/banner/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Gambar</label>
                            <div class="input-upload" name="foto_slider" label="Upload Gambar"
                                image="/assets/img/nofoto.png"></div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Teks Alternatif</label>
                            <input type="text" class="form-control" name="alt" placeholder="Teks alternatif" required />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Link</label>
                            <input type="text" class="form-control" name="link" placeholder="Link" />
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Urutan</label>
                            <input type="number" class="form-control" name="order" placeholder="0" />
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Kondisi</label>
                            <select class="form-control" name="kondisi" required>
                                <option value="POSTING">Posting</option>
                                <option value="DRAFT">Draft</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='addBannerKelas' tabindex='-1' role='dialog' aria-labelledby='modelTitleId'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Tambah Banner Kelas</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <form action="/admin/banner-kelas/tambah" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" placeholder="judul" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <select name="id_kelas" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value='{{ $k->id_kelas }}'>
                                        {{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Urutan</label>
                            <input type="number" class="form-control" name="order" placeholder="0" />
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Kondisi</label>
                            <select class="form-control" name="kondisi" required>
                                <option value="POSTING">Posting</option>
                                <option value="DRAFT">Draft</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Gambar</label>
                            <div class="input-upload" name="gambar" label="Upload Gambar" image="/assets/img/nofoto.png">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@push('custom-js')
    @include('admin.component.input-upload')
@endpush
