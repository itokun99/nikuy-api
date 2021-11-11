@extends('web.layout.container')

@push('style')
    <link rel="stylesheet" href="/assets/css/course-info.css">
    <link rel="stylesheet" href="/assets/css/modal-login-daftar.css">
    <style>
        .sidebar {
            color: #fff;
        }

        #root {
            min-height: 0;
        }

        .disabled {
            color: dimgray;
        }

        .disabled:hover {
            transition: 2s;
            color: grey;
        }

    </style>
@endpush

@section('content')
    @include('sidebar')
    <div class="course-content content">
        <div class='card'>
            <div class='card-header'>
                {{ $content->nama_kursus }}
            </div>
            <div class='card-body'>
                <br>
                <center>
                    <img src='{{ $content->foto_kelas ? '/assets/foto/kelas/' . $content->foto_kelas : '/assets/foto/kursus/' . $content->foto_kursus }}'
                        alt='{{ $kelas->nama_kelas }}' width='55%'>
                </center>
                <div class='drop-text-content'>
                    {!! $content->deskripsi !!}
                </div>
            </div>
        </div>
        <div class="footer-content-btn">
            @if ($previous)
                <a class="btn btn-next-content" href="/course/{{ $content->id_kelas }}/sub/{{ $previous }}">&lt;
                    Sebelumnya</a>
            @endif
            <!--
                                                                                                **************Buat Next Class****************
                                                                                            -->
            @if ($next)
                <a class='btn btn-prev-content'
                    href='/course/{{ $content->id_kelas }}/sub/{{ $next }}'>Selanjutnya
                    &gt;</a>
            @endif
        </div>
    </div>
    <div id="content-unduh-trigger" class="unduh-content content">
        <div class="isi-unduh">
            <h1>Coming Soon</h1>
            <!-- <a class="btn btn-next" href="">Selanjutnya &gt;</a> -->
        </div>
    </div>

    <div class="nav-responsive">
        <div class="content-title">
            <h2>Konten Kelas #Nomor</h2>
        </div>

        @foreach ($kursus as $key => $kursuss)
            <div class='pilar-dropdown'>
                <a class='btn btn-dropdown turunin1 cs-btn-dropdownpilar{{ str_replace(' ', '', $kursuss[0]->id_pilar) }}'
                    href='#' id='pilar{{ str_replace(' ', '', $kursuss[0]->id_pilar) }}' role='button'
                    data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    {{ $key }} <img src='/assets/img/Collapse Arrow Down.png'>
                </a>
                <div class='drop-menu naikin1 cs-drop-menupilar{{ str_replace(' ', '', $kursuss[0]->id_pilar) }}'
                    aria-labelledby='#pilar{{ str_replace(' ', '', $kursuss[0]->id_pilar) }}'>

                    @foreach ($kursuss as $course)

                        <a class='drop-item tampil1'
                            href='/course/{{ $kelas->id_kelas }}/sub/{{ $course->id_kursus }}'>
                            <img src='/assets/img/Circled Play.png'>
                            <div class='drop-text'>
                                <p class='drop-item-title'>{{ $key }}</p>
                                <p class='drop-item-desc'>{{ $course->nama_kursus }}</p>
                            </div>

                        </a>

                    @endforeach

                </div>
            </div>

        @endforeach

        <div class="rating">
            <a class="btn tombol-rating" href="/rating/{{ $kelas->id_kelas }}">Rating dan Komentar</a>
        </div>
    </div>




    </div>



    </div>
    <style>
        #pesanAwal,
        #pesanUpgrade {
            display: none;
            width: 700px;
            background-color: black;
            color: white;
        }

        #pesanAwal img,
        #pesanUpgrade img {
            display: block;
            margin: auto;
        }

        #pesanAwal a,
        #pesanUpgrade a {
            width: 100%;
        }

    </style>

    <!-- Button trigger modal -->

    <div id="pesanAwal">

        <img src="/assets/img/Lock.png" width="25%">
        <h2 align="center">Maaf</h2>
        <p align="center">Anda harus melakukan pendaftaran terlebih dahulu...</p>

        <a href='#' id="tombolAwal" class="btn btn-warning text-white">
            <h4>Daftar</h4>
        </a>
    </div>

    <div id="pesanUpgrade">

        <img src="/assets/img/Lock.png" width="25%">
        <h2 align="center">Upgrade Status Membership</h2>
        <p align="center">Anda harus Upgrade Status terlebih dahulu...</p>

        <a href='/membership' id="tombolUpg" class="btn btn-warning text-white">
            <h4>Upgrade</h4>
        </a>
    </div>




    <div class="modal fade" id="editUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="?hal=akun-respon&mode=edit" enctype="multipart/form-data">
                        <p>
                            <input value="omat" class="form-control" type="text" name="nama" placeholder="Nama Lengkap"
                                required>
                        </p>
                        <p>
                            <textarea id="my-textarea" class="form-control" name="alamat" placeholder="Alamat"
                                rows="3">sasasa</textarea>
                        </p>
                        <p>
                            <input value="21212" class="form-control" type="number" name="nohp"
                                placeholder="No. Handphone" required>
                        </p>
                        <p>
                            <input value="otamat@gmail.com" class="form-control" type="email" name="email"
                                placeholder="E-Mail" required>
                        </p>



                        <p>
                            <input value="123456" class="form-control tampilinPass" type="password" name="password"
                                placeholder="Password" required>
                            &nbsp;<input type="checkbox" class="tampilPassword"> <small>Tampilkan Password</small> <br>
                        </p>


                        <p>
                            <input type="submit" value="SIMPAN" class="btn btn-primary">
                        </p>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection


@push('custom-js')
    <!--Bootstrap JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <!--Slick JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous"></script>

    <!--fancybox-->
    <script src="/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
    <script src="/assets/vendor/tambahan/perKelasan.js"></script>
    <script src="/assets/vendor/tambahan/tools.js"></script>
    <script src="/assets/vendor/tambahan/rating.js"></script>

    <script>
        $(document).ready(function() {
            $('video').attr('controlsList', 'nodownload');
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.turunin1').click(function(e) {
                e.preventDefault();
                if ($('.tampil1').css('display') == 'none') {
                    $('.tampil1').css('display', 'block');
                    $('.turunin1 img').attr('src', '/assets/img/Collapse Arrow Up.png');
                } else {
                    $('.tampil1').css('display', 'none');
                    $('.turunin1 img').attr('src', '/assets/img/Collapse Arrow Down.png');
                }
            });

            $('.turunin2').click(function(e) {
                e.preventDefault();
                if ($('.tampil2').css('display') == 'none') {
                    $('.tampil2').css('display', 'block');
                    $('.turunin2 img').attr('src', '/assets/img/Collapse Arrow Up.png');
                } else {
                    $('.tampil2').css('display', 'none');
                    $('.turunin2 img').attr('src', '/assets/img/Collapse Arrow Down.png');
                }
            });

        });
    </script>
@endpush
