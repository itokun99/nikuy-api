@extends('admin.layout.container')

@section('title')
    @if ($event)
        Edit Event {{ $event->nama_event }} - ELITES Admin
    @else
        Tambah Event - ELITES Admin
    @endif
@stop

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/event">Event</a></li>

            @if ($event)
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $event->nama_event }}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            @endif
        </ol>
    </nav>
@stop

@section('content')
    <!-- Topbar -->

    <form action="@if ($event) /admin/event/edit/{{ $event->id_event }} @else /admin/event/tambah @endif" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Event</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Nama Event</label>
                                <input class="form-control" type="text" name="nama_event" placeholder="Nama / Judul Event"
                                    value="{{ $event->nama_event ?? '' }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi"
                                    class="ckeditor form-control">{{ $event->deskripsi ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Info Tambahan</h6>
                        </div>


                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Lokasi</label>
                                <textarea name="lokasi" placeholder="Lokasi" rows="5" class="form-control"
                                    required>{{ $event->lokasi ?? '' }}</textarea>
                            </div>


                            <div class="form-group">
                                <label class="form-label">Venue</label>
                                <input class="form-control" type="text" name="venue" value="{{ $event->venue ?? '' }}"
                                    placeholder="Venue">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Waktu Pelaksanaan</label>
                                @if ($event)
                                    <input type="datetime-local" name="waktu" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($event->waktu)->format('Y-m-d') }}T{{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }}"
                                        required />
                                @else
                                    <input type="datetime-local" name="waktu" class="form-control" value="" required />
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-label">Kuota Peserta</label>
                                <input class="form-control" type="number" name="kuota" value="{{ $event->kuota ?? '' }}"
                                    placeholder="Jumlah Peserta" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input class="form-control" type="number" name="harga_event"
                                        value="{{ $event->harga_event ?? '' }}" placeholder="Harga" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Harga Diskon (Opsional)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input class="form-control" type="number" name="harga_diskon"
                                        value="{{ $event->harga_diskon ?? '' }}" placeholder="Masukan harga diskon" />
                                </div>
                                <small class="text-muted">Input "0" untuk event diskon "Free", kosongkan untuk tanpa
                                    diskon</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Urutan</label>
                                <input class="form-control" type="number" name="order_id"
                                    value="{{ $event->order_id ?? '' }}" placeholder="1-100" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">

                    <div id="event-author" data-author-id="{{ $event->id_user ?? '' }}"></div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Gambar Event</h6>
                        </div>


                        <div class="card-body">
                            <div id="input-upload" name="foto_event" label="Upload Foto"
                                image="{{ $event && $event->foto_event ? '/assets/foto/event/' . $event->foto_event : '/assets/img/nofoto.png' }}">
                            </div>
                            <small class="form-text text-muted">Rekomendasi 600x450</small>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <input type="submit" value="POSTING" class="btn btn-primary" name="kondisi">
                            <input type="submit" value="DRAFT" class="btn btn-secondary" name="kondisi">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop


@push('custom-js')
    @include('admin.component.editorscript')
    @include('admin.component.author-select')
    @include('admin.component.input-upload')
@endpush
