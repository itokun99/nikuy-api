@extends('web.layout.container')

@section('content')

    <link rel="stylesheet" href="/assets/css/course-info.css">

    @include('slidebar')



    <div class="container container-course-info">

        <style>
            .disabled {
                color: dimgray;
            }

            .disabled:hover {
                transition: 2s;
                color: grey;
            }

        </style>


        @include('sidebar')


        <div class="course-content content">

            <!-- MATERI CONTENT-->

            <center>
                <div class="modal-rating">
                    <h1>Beri Rating Kelas</h1>
                    <form action="/rating/{{ $kelas->id_kelas }}" method="post">
                        @csrf
                        <input type="hidden" name="star" id="star_val"
                            value="{{ empty($rating) ? 4 : $rating->level_rating }}">
                        <div class="star d-flex justify-content-center">
                            <a href="#"><img src="/assets/img/Star_6.svg" id="star1" width="60" alt=""></a>
                            <a href="#"><img src="/assets/img/Star_6.svg" id="star2" width="60" alt=""></a>
                            <a href="#"><img src="/assets/img/Star_6.svg" id="star3" width="60" alt=""></a>
                            <a href="#"><img src="/assets/img/Star_6.svg" id="star4" width="60" alt=""></a>
                            <a href="#"><img src="/assets/img/Star_5.svg" id="star5" width="60" alt=""></a>
                        </div>

                        <label for="">Berikan Komentar</label>
                        <textarea name="komentar" required>{{ empty($rating) ? '' : $rating->komentar }}</textarea>
                        <input type="submit" class="btn btn-warning btn-lg text-white" value="Kirim Rating dan Komentar">
                    </form>
                </div>
            </center>
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

        <a href="http://localhost/elites/index.php?hal=course-rating&amp;k=3&amp;p=7#" id="tombolAwal"
            class="btn btn-warning text-white">
            <h4>Daftar</h4>
        </a>
    </div>

    <div id="pesanUpgrade">

        <img src="/assets/img/Lock.png" width="25%">
        <h2 align="center">Upgrade Status Membership</h2>
        <p align="center">Anda harus Upgrade Status terlebih dahulu...</p>

        <a href="http://localhost/elites/index.php?hal=akun-membership&amp;tuj=profile" id="tombolUpg"
            class="btn btn-warning text-white">
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
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="http://localhost/elites/index.php?hal=akun-respon&amp;mode=edit"
                        enctype="multipart/form-data">
                        <p>
                            <input value="Danny Julian" class="form-control" type="text" name="nama"
                                placeholder="Nama Lengkap" required="">
                        </p>
                        <p>
                            <textarea id="my-textarea" class="form-control" name="alamat" placeholder="Alamat"
                                rows="3">Antapani</textarea>
                        </p>
                        <p>
                            <input value="08989898989" class="form-control" type="number" name="nohp"
                                placeholder="No. Handphone" required="">
                        </p>
                        <p>
                            <input value="julianpratamad@gmail.com" class="form-control" type="email" name="email"
                                placeholder="E-Mail" required="">
                        </p>



                        <p>
                            <input value="123456" class="form-control tampilinPass" type="password" name="password"
                                placeholder="Password" required="">
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
<script>
    $(document).ready(function() {

        // $('.turunin1').click(function (e) {
        //     e.preventDefault();
        //     if ($('.tampil1').css('display') == 'none') {
        //         $('.tampil1').css('display', 'block');
        //         $('.turunin1 img').attr('src', '/assets/img/Collapse Arrow Up.png');
        //     } else {
        //         $('.tampil1').css('display', 'none');
        //         $('.turunin1 img').attr('src', '/assets/img/Collapse Arrow Down.png');
        //     }
        // });

        // $('.turunin2').click(function (e) {
        //     e.preventDefault();
        //     if ($('.tampil2').css('display') == 'none') {
        //         $('.tampil2').css('display', 'block');
        //         $('.turunin2 img').attr('src', '/assets/img/Collapse Arrow Up.png');
        //     } else {
        //         $('.tampil2').css('display', 'none');
        //         $('.turunin2 img').attr('src', '/assets/img/Collapse Arrow Down.png');
        //     }
        // });

    });
</script>
