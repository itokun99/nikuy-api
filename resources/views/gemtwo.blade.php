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
            @foreach ($gemtwo as $gemtwos)
                <div class='card'>
                    <div class='card-header'>
                        GEM
                    </div>
                    <div class='card-body'>

                        <h2 align='center'>{{ $gemtwos->nama_kursus }}</h2>
                        <br>
                        <center>
                            <img src='/assets/foto/kursus/{{ $gemtwos->foto_kursus }}' alt='Belajar Sukses' width='55%'>
                        </center>

                        <div class='drop-text-content'>
                            <p><strong>Keterangan:</strong></p>

                            <p>akakjajja hahAK ahhakakhkhak ahkhAKha ahkahk.&nbsp;akakjajja hahAK ahhakakhkhak ahkhAKha
                                ahkahk.&nbsp;akakjajja hahAK ahhakakhkhak ahkhAKha ahkahk.&nbsp;akakjajja hahAK ahhakakhkhak
                                ahkhAKha ahkahk.&nbsp;akakjajja hahAK ahhakakhkhak ahkhAKha ahkahk.&nbsp;akakjajja hahAK
                                ahhakakhkhak ahkhAKha ahkahk.</p>

                        </div>

                    </div>
                </div>
            @endforeach




            <div class="footer-content-btn">
                <!--<a class="btn btn-next-content bg-warning" href="">&lt; Sebelumnya</a>-->
                <!--prev kursus-->
                <a class='btn btn-prev-content' href='?hal=course-detail&pl=28&k=3&p=5&pilid=1'>&lt; Sebelumnya</a>
                <!--next kursus-->
                <a href='#' class='btn btn-prev-content' data-fancybox data-src='#pesanUpgrade'
                    href='javascript:;'>Selanjutnya &gt;</a>
            </div>

        </div>



    </div>


    <div class="content modal-rated-content">
        <div class="modal-rating">
            <a class="close-modal-rating" href=""><img src="Cancel.png" alt=""></a>
            <h1>Rating Sudah Dikirim</h1>
            <img src="Ok (1).png" alt="">
            <a class="btn-form-rated" href="">Kirim Rating dan Komentar</a>
            <a class="back-to-menu" href="">Kembali Ke Menu</a>
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

        <a href='?hal=akun-membership&tuj=profile' id="tombolUpg" class="btn btn-warning text-white">
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
<script>
    $(document).ready(function() {

        $('.turunin1').click(function(e) {
            e.preventDefault();
            if ($('.tampil1').css('display') == 'none') {
                $('.tampil1').css('display', 'block');
                $('.turunin1 img').attr('src', 'img/Collapse Arrow Up.png');
            } else {
                $('.tampil1').css('display', 'none');
                $('.turunin1 img').attr('src', 'img/Collapse Arrow Down.png');
            }
        });

        $('.turunin2').click(function(e) {
            e.preventDefault();
            if ($('.tampil2').css('display') == 'none') {
                $('.tampil2').css('display', 'block');
                $('.turunin2 img').attr('src', 'img/Collapse Arrow Up.png');
            } else {
                $('.tampil2').css('display', 'none');
                $('.turunin2 img').attr('src', 'img/Collapse Arrow Down.png');
            }
        });

    });
</script>
